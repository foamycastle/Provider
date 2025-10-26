<?php

namespace Foamycastle\Provider;

abstract class Provider implements ProviderContract
{
    /**
     * Set to true when the provider has performed its responsibility.
     * Set to false after the data has been read.
     * @var bool
     */
    protected bool $dataFresh = false;

    /**
     * Indicates that data has been calculated or gather and is read to be read
     * @var bool
     */
    protected bool $dataExists = false;

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
    protected mixed $data;
    public protected(set) string $dataType{
        get{
            if(is_object($this->data)){
                return get_class($this->data);
            }
            return gettype($this->data);
        }
        set{

        }
    }


}