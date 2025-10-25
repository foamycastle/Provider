<?php

namespace Foamycastle\Utilities\UUID\Providers;

use Foamycastle\Provider\NumberProvider;

class GregorianTimeProvider extends NumberProvider
{
    public const int GREGORIAN_CONSTANT = 122192928000000000;

    /**
     * The point in time at which the last calculation of gregorian time was made
     * @var int
     */
    protected static int $lastTime;
    public function __construct()
    {
        self::$lastTime = $this->provide(true);
    }

    /**
     * @inheritDoc
     */
    function getValue(): int
    {
        $output = $this->processedValue ?? $this->data;
        unset($this->processedValue);
        return $output;
    }

    /**
     * @inheritDoc
     */
    function refresh(...$options): void
    {
        $time = gettimeofday();
        $secs=($time["sec"]*10000000)+self::GREGORIAN_CONSTANT;
        $usecs=($time["usec"]*10);
        $nsecs=rand(0,9);
        $this->data=$secs+$nsecs+$usecs;
    }

    /**
     * @inheritDoc
     */
    function provide(bool $fresh, ...$options): int
    {
        if ($fresh) {
            $this->refresh();
            self::$lastTime=$this->data;
            return $this->data;
        }
        return self::$lastTime ?? $this->data;
    }
}