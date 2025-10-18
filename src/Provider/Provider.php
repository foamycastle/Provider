<?php

namespace FoamyCastle\Provider;

abstract class Provider implements ProviderContract
{
    /**
     * @var mixed $data a temporary cache for generated data
     */
    protected mixed $data;

    /**
     * a string containing a user-generated error message
     * @var string
     */
    protected string $errorString {
        set(string $errorString){
            $this->errorString = $errorString;
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
    }



}