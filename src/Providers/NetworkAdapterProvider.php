<?php

namespace Foamycastle\Utilities\UUID\Providers;
use Foamycastle\Provider\StringProvider;

abstract class NetworkAdapterProvider extends StringProvider
{
    const string ADDR_LINUX = 'ifconfig -a | grep ether';
    const string ADDR_DARWIN = 'ifconfig -a | grep ether';
    const string ADDR_WIN = 'ipconfig /all | findstr "Physical"';
    const string ADDR_FREE_BSD = 'ifconfig -a';
    const string ADDR_DEFAULT = 'FFFFFFFFFFFF';
    protected string $os_identifier;
    protected string $networkInterfaceCommand;

    protected function __construct()
    {
        $this->setShellCommand();
    }
    protected function getOS():string
    {
        return strtoupper(substr(php_uname('s'),0,3));
    }

    /**
     * @inheritDoc
     */
    function provide(bool $fresh, ...$options): mixed
    {
        $addrCount = count($this->data);
        if ($addrCount == 0) {
            $this->data = [new RandomStringProvider(6, true)];
        }
        if (isset($options['address'])) {
            return match ($options['address']) {
                'first' => (string)$this->data[0],
                'last' => (string)$this->data[$addrCount - 1],
                'random' => (string)(new RandomStringProvider(6, true)),
            };
        }
        return (string)$this->data[0];
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->provide(false, ['address' => 'first']);
    }

    protected function getShellOutput():?string
    {
        return `$this->networkInterfaceCommand`;
    }

    protected function setShellCommand():void
    {
        $this->os_identifier = $this->getOS();
        $this->networkInterfaceCommand = match ($this->os_identifier) {
            "WIN"=>self::ADDR_WIN,
            "LIN"=>self::ADDR_LINUX,
            "DAR"=>self::ADDR_DARWIN,
            "FRE"=>self::ADDR_FREE_BSD
        };
    }
    protected function filterAddress(string $address):string
    {
        return str_replace([':',"-"],'',substr(trim($address,"\n\t\r\0 :."),-17));
    }
}