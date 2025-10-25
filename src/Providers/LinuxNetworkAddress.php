<?php

namespace Foamycastle\Utilities\UUID\Providers;

use Foamycastle\Utilities\UUID\Providers\NetworkAdapterProvider;

class LinuxNetworkAddress extends NetworkAdapterProvider
{
    public function __construct()
    {
        //get the OS, choose the proper command to execute
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

        $count=preg_match("/(?i)(?<=ether |hwaddr )([a-f0-9(\-:)]{17})/", $command, $matches);
        //if no addresses are recovered, offer default
        if($count==0){
            $this->data[]=new RandomStringProvider(6, true);
        }
        $matches=$matches[0];
        array_walk($matches, function (&$value) {
            $value=$this->filterAddress($value);
            if(strlen($value)!=12){
                $value=new RandomStringProvider(6, true);
            }
        });
        $this->data=$matches;
    }
}