<?php

namespace Foamycastle\Utilities\UUID\Providers;

use Foamycastle\Provider\StringProvider;

class RandomStringProvider extends StringProvider
{
    public function __construct(
        protected int $byteLength = 4,
        protected bool $hex = false
    )
    {
        $this->refresh();
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->data;
    }

    /**
     * @inheritDoc
     */
    function refresh(...$options): void
    {
        $this->data = random_bytes($this->byteLength);

        //if the hex property is true or if the option for hex provided late, return a hex string
        if($this->hex || (isset($options['hex'])&&$options['hex']===true)){
            $this->data = bin2hex($this->data);
        }
    }

    /**
     * @inheritDoc
     */
    function provide(bool $fresh, ...$options): mixed
    {
        return (string)$this;
    }
}