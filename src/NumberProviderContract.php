<?php

namespace Foamycastle\Provider;

interface NumberProviderContract
{
    /**
     * Shift bits left
     * @param int $byBits
     * @return self
     */
    function shiftLeft(int $byBits):self;

    /**
     * Shift bits right
     * @param int $byBits
     * @return self
     */
    function shiftRight(int $byBits):self;

    /**
     * Perform AND comparison of bits
     * @param int $andValue
     * @return self
     */
    function andOp(int $andValue):self;

    /**
     * Perform OR comparison of bits
     * @param int $orValue
     * @return self
     */
    function orOp(int $orValue):self;

    /**
     * Invert all bits
     * @return self
     */
    function invert():self;

    /**
     * The generated data
     * @return int|float
     */
    function getValue(): mixed;
}