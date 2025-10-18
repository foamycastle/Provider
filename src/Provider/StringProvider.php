<?php

namespace FoamyCastle\Provider;

use FoamyCastle\Provider\Provider;

abstract class StringProvider extends Provider implements StringProviderContract
{
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
    public function __toString(): string
    {
        return ($this->data ?? "");
    }


}