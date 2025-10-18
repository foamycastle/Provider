<?php

namespace FoamyCastle\Provider;

abstract class Provider implements ProviderContract
{
    /**
     * @var mixed $data a temporary cache for generated data
     */
    protected mixed $data;

    /**
     * a string containing a user-generated error message. error message is clear upon read
     * @var string
     */
    protected string $errorString {
        set(string $errorString){
            $this->errorString = $errorString;
        }
        get{
            $temp = $this->errorString;
            $this->errorString = "";
            return $temp;
        }
    }

    /**
     * A number associated with an error
     * @var int
     */
    protected int $errorNumber{
        set(int $errorNumber){
            $this->errorNumber = $errorNumber;
        }
        get {
            $temp = $this->errorNumber;
            $this->errorNumber = 0;
            return $temp;
        }
    }



}