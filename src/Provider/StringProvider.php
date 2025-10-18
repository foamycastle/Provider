<?php

namespace FoamyCastle\Provider;

use FoamyCastle\Provider\Provider;

abstract class StringProvider extends Provider implements StringProviderContract
{
    /**
     * Indicates the input data is an array
     * @var bool
     */
    protected bool $isArray=false;

    /**
     * an export format
     * @var string
     */
    protected string $format;

    /**
     * if true, each call to _toString will have the format applied, if the format has been provided.  If false, the format will only be applied to the subsequent call to _toString
     * @var bool
     */
    protected bool $persistantFormat=false;

    /**
     * The input data
     * @var mixed
     */
    protected mixed $data{
        set(mixed $data) {
            if(is_array($data)) {
                $this->data = $data;
                $this->isArray = true;
                return;
            }
            if (!is_scalar($data)) {
                $this->errorString = "data must be a scalar";
                throw new \Exception("data for StringProvider must be a scalar");
            }
            if(is_bool($data)) {
                $this->data = ($data ? "true" : "false");
                return;
            }
            $this->data = (string)$data;
        }
    }
    /**
     * Return the length of $data
     * @var int
     */
    public int $len {
        get => strlen($this->data ?? "");
    }
    /**
     * Return the crc32 of a string
     * @var string
     */
    public string $crc32 {
        get => crc32($this->data ?? "");
    }

    /**
     * Returns the string in reverse
     * @var string
     */
    public string $rev {
        get => strrev($this->data ?? "");
    }

    /**
     * Tests for a hexadecimal string
     * @var bool
     */
    public bool $isHex{
        get{
            return preg_match("/^[0-9A-F]+$/", ($this->data ?? ""))==1;
        }
    }

    /**
     * Tests for an octal string
     * @var bool
     */
    public bool $isOctal{
        get{
            return preg_match("/^[0-7]+$/", ($this->data ?? ""))==1;
        }
    }

    /**
     * Tests for a decimal number in the string
     * @var bool
     */
    public bool $isDecimal{
        get{
            return preg_match("/^[0-9]+\.[0-9]+$/", ($this->data ?? ""))==1;
        }
    }

    /**
     * Tests for an integer in the string
     * @var bool
     */
    public bool $isInt{
        get => preg_match("/^[0-9]+$/", ($this->data ?? ""))==1;
    }

    /**
     * Returns the data.  If a format has been provided, the data is return in the specified format
     * @return string
     */
    public function __toString(): string
    {
        /** @var string $outputString */
        $outputString='';
        if($this->isArray) {
            $outputString = isset($this->format)
                ? sprintf($this->format, ...$this->data)
                : join("; ", $this->data);
        }else {
            if (isset($this->format)) {
                $outputString = sprintf($this->format, $this->data);
                if (!$this->persistantFormat) {
                    unset($this->format);
                }
            }else {
                $outputString = $this->data;
            }
        }
        return $outputString;
    }

    /**
     * Set the format for export
     * @param string $format
     * @return $this
     */
    public function withFormat(string $format): self
    {
        $this->format = $format;
        return $this;
    }

    /**
     * Sets the option for persistant formatting
     * @param bool $format
     * @return $this
     */
    public function persistantFormat(bool $format): self
    {
        $this->persistantFormat = $format;
        return $this;
    }



}