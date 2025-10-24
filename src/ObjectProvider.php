<?php

namespace Foamycastle\Provider;

use ReflectionObject;
use function array_any;
use function get_class;
use function strtolower;

abstract class ObjectProvider extends Provider implements ObjectProviderContract
{

    /**
     * @var object $object a reference to the object
     */
    protected object $object;

    /**
     * @var ReflectionObject $reflectionObject used for object examination
     */
    protected \ReflectionObject $reflectionObject;

    /**
     * @inheritDoc
     */
    public function getObjectClass(): ?string
    {
        return get_class($this->data);
    }

    /**
     * @inheritDoc
     */
    function hasMethod(string $member): bool
    {
        if(!$this->reflectionInitd()){
            $this->initReflection();
        }
        $methods=$this->reflectionObject->getMethods();
        $member=strtolower($member);
        return array_any($methods, fn($method) => strtolower($method->getName()) == $member && $method->isPublic());
    }

    /**
     * @inheritDoc
     */
    function hasProp(string $member): bool
    {
        if(!$this->reflectionInitd()){
            $this->initReflection();
        }
        $props=$this->reflectionObject->getProperties();
        $member=strtolower($member);
        return array_any($props, fn($prop) => strtolower($prop->getName()) == $member && $prop->isPublic());
    }


    /**
     * Prepare the internal object for reflection
     * @return void
     */
    protected function initReflection():void
    {
        $this->reflectionObject = new ReflectionObject($this);
    }

    /**
     * Indicates that reflection prep has completed
     * @return bool
     */
    protected function reflectionInitd():bool
    {
        return !empty($this->reflectionObject);
    }

}