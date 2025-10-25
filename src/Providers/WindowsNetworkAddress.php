<?php

namespace Foamycastle\Utilities\UUID\Providers;

class WindowsNetworkAddress extends NetworkAdapterProvider
{
    public function __construct()
    {
        parent::__construct();
        $this->refresh();
    }

    /**
     * @inheritDoc
     */
    function refresh(...$options): void
    {
        $command = $this->getShellOutput();

        //command execution failed, provide default address
        if($command===null){
            $this->data[]=new RandomStringProvider(6, true);
            return;
        }

        $matches = preg_split("/([\x0a\x0d])/", $command, -1, PREG_SPLIT_NO_EMPTY);
        //if no addresses are recovered, offer default
        if(empty($matches)){
            $this->data[]=new RandomStringProvider(6, true);
        }
        array_walk($matches, function (&$value) {
            $value=$this->filterAddress($value);
            if(strlen($value)!=12){
                $value=new RandomStringProvider(6, true);
            }
        });
        $this->data=$matches;
    }

}