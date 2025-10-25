<?php

namespace Foamycastle\Utilities\UUID\Providers;

use Foamycastle\Provider\StringProvider;

class UUIDProvider extends StringProvider
{
    public readonly bool $isBinString;
    public readonly bool $isHexString;
    public readonly bool $isRandom;
    public function __construct(
        private string $inputData
    )
    {
        $this->isBinString = strlen($inputData)==16;
        if ($this->isBinString) {
            $this->data = $inputData;
            $this->isRandom=false;
            $this->isHexString=false;
            return;
        }
        $replace=preg_replace('/(i?)[^a-f0-9]/', '',$inputData);
        $this->isHexString=strlen($replace)==32;
        if ($this->isHexString) {
            $this->data = $replace;
            $this->isRandom=false;
            return;
        }
        $this->inputData = $this->data = '';
        $this->isRandom=true;
        for($i=0;$i<=15;$i++){
            $this->data .= chr(rand(0, 255));
        }

    }

    public function __toString(): string
    {
        if($this->isBinString || $this->isRandom){
            return bin2hex($this->data);
        }
        return $this->data;
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
    function provide(bool $fresh, ...$options): string
    {
        return (string)$this;
    }
}