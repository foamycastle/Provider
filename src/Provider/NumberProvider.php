<?php

namespace FoamyCastle\Provider;

use FoamyCastle\Provider\Provider;

abstract class NumberProvider extends Provider implements NumberProviderContract
{
    /**
     * @inheritDoc
     */
    function shiftLeft(int $byBits): \FoamyCastle\Provider\NumberProviderContract
    {
        $this->data <<= $byBits;
        return $this;
    }

    /**
     * @inheritDoc
     */
    function shiftRight(int $byBits): \FoamyCastle\Provider\NumberProviderContract
    {
        $this->data >>= $byBits;
        return $this;
    }

    /**
     * @inheritDoc
     */
    function andOp(int $andValue): \FoamyCastle\Provider\NumberProviderContract
    {
        $this->data &= $andValue;
        return $this;
    }

    /**
     * @inheritDoc
     */
    function orOp(int $orValue): \FoamyCastle\Provider\NumberProviderContract
    {
        $this->data |= $orValue;
        return $this;
    }

    /**
     * @inheritDoc
     */
    function invert(): \FoamyCastle\Provider\NumberProviderContract
    {
        $this->data = ~$this->data;
        return $this;
    }
}