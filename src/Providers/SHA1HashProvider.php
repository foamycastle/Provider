<?php

namespace Foamycastle\Utilities\UUID\Providers;

class SHA1HashProvider extends HashProvider
{
    public function __construct(
        string|UUIDProvider $namespace,
        string $name,
    )
    {
        parent::__construct($namespace);
        $this->data = sha1($this->namespace . $name);
    }

}