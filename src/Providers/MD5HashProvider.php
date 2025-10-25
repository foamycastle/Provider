<?php

namespace Foamycastle\Utilities\UUID\Providers;

class MD5HashProvider extends HashProvider
{
    public function __construct(
        string|UUIDProvider $namespace,
        string $name
    )
    {
        parent::__construct($this->namespace);
        $this->data = md5($this->namespace . $name);
    }

    /**
     * @inheritDoc
     */
    function refresh(...$options): void
    {
        return;
    }

    /**
     * @inheritDoc
     */
    function provide(bool $fresh, ...$options): mixed
    {
        // TODO: Implement provide() method.
    }

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
    }
}