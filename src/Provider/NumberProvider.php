<?php

namespace FoamyCastle\Provider;

use FoamyCastle\Provider\Provider;

abstract class NumberProvider extends Provider implements NumberProviderContract
{
    /**
     * @var int holds the result of calculations
     */
    protected int $processedValue;
    /**
     * @inheritDoc
     */
    function shiftLeft(int $byBits): \FoamyCastle\Provider\NumberProviderContract
    {
        $this->processedValue=$this->data << $byBits;
        return $this;
    }

    /**
     * @inheritDoc
     */
    function shiftRight(int $byBits): \FoamyCastle\Provider\NumberProviderContract
    {
        $this->processedValue=$this->data >> $byBits;
        return $this;
    }

    /**
     * @inheritDoc
     */
    function andOp(int $andValue): \FoamyCastle\Provider\NumberProviderContract
    {
        $this->processedValue=$this->data & $andValue;
        return $this;
    }

    /**
     * @inheritDoc
     */
    function orOp(int $orValue): \FoamyCastle\Provider\NumberProviderContract
    {
        $this->processedValue=$this->data | $orValue;
        return $this;
    }

    /**
     * @inheritDoc
     */
    function invert(): \FoamyCastle\Provider\NumberProviderContract
    {
        $this->processedValue = ~$this->data;
        return $this;
    }
}