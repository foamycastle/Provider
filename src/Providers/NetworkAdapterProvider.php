<?php

namespace Foamycastle\Utilities\UUID\Providers;
use Foamycastle\Provider\StringProvider;

class NetworkAdapterProvider extends StringProvider
{
    const string ADDR_DEFAULT = 'FFFFFFFFFFFF';
    protected string $os_identifier;
    protected static array $cached;

    public function __construct()
    {
        if(!empty(self::$cached)) {
            $this->data=self::$cached;
            return;
        }
        $this->os_identifier = $this->getOsIdentifier();
        foreach ($this->commandCycle() as [$command,$regex]) {
            $exeCommand=$this->executeCommand($command);
            if($exeCommand===null) {
                continue;
            }
            $parsedRegex = $this->applyRegex($exeCommand,$regex);
            if(empty($parsedRegex)) continue;
            $this->data = array_merge($this->data ?? [],$parsedRegex);
            self::$cached = array_merge(self::$cached ?? [],$parsedRegex);
        }
        if($exeCommand===null) {
            $this->data=[(string)(new RandomStringProvider(6,true))];
        }
    }



    /**
     * Return a 3-letter string that identifies the system's OS
     * @return string
     */
    function getOsIdentifier(): string
    {
        $uname = strtoupper(php_uname('s'));
        return substr($uname, 0, 3);
    }

    function commandCycle():\Generator
    {
        $commandArray=NETWORK_ADAPTER_COMMANDS[$this->os_identifier];
        do{
            yield current($commandArray);
        }while (next($commandArray) !== false);
    }

    /**
     * Execute the command that will return information about system's interfaces
     * @param string $command
     * @return string|null
     */
    function executeCommand(string $command):?string{
        if(function_exists("shell_exec")){
            return (shell_exec($command) ?: "");
        }
        if(function_exists("exec")){
            if(exec($command, $outputstring) === false){
                return null;
            }
            return join("\n",$outputstring);
        }
        if(function_exists("passthru")){
            ob_start();
            if(passthru($command)===null){
                $outputstring = ob_get_clean();
                return $outputstring;
            }
            ob_end_clean();
            return null;
        }
        return null;
    }

    function applyRegex(string $commandOutput, string $regex):array
    {
        $matches = [];
        $isMatch = preg_match_all($regex, $commandOutput, $matches);
        if($isMatch!=0 || $isMatch!==false){
            return $matches[1];
        }
        return [];
    }

    public function __toString(): string
    {
        return $this->data[0] ?? new RandomStringProvider(6,true);
    }

    function refresh(...$options): void
    {
        return;
    }

    function provide(bool $fresh, ...$options): string|array
    {
        if($options){
            if(isset($options['address'])){
                switch(strtolower($options['address'])){
                    case is_int($options['address']):
                        return $this->data[$options['address']] ?? new RandomStringProvider(6,true);
                    default:
                        return $this->data[0] ?? new RandomStringProvider(6,true);
                }
            }
            if(is_int($options[0])){
                return $this->data[$options[0]] ?? new RandomStringProvider(6,true);
            }
        }
        return $this->data;
    }
}