<?php

namespace Foamycastle\Utilities\UUID\Providers;

use Foamycastle\Provider\StringProvider;

abstract class HashProvider extends StringProvider
{
    public function __construct(
        protected string|UUIDProvider $namespace
    )
    {
        // if not supplied with a UUIDProvider, which performs the following validations/cleansing,
        // trim invalid chars from namespace
        if(!is_object($this->namespace)) {
            $this->namespace = preg_replace('/(?i)^[^a-f0-9]$/', '', $this->namespace);
            if (strlen($this->namespace) != 32) {
                $this->errorNumber = 0x80;
                $this->errorString = "namespace {$this->namespace} is not a valid UUID namespace";
            }
        }
    }

    /**
     * @inheritDoc
     */
    function provide(bool $fresh, ...$options): mixed
    {
        return (string)$this;
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
        return;
    }
}