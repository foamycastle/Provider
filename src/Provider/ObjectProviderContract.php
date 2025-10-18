<?php

namespace FoamyCastle\Provider;

interface ObjectProviderContract
{
    /**
     * returns the classname of the object provided
     * @return string|null
     */
    function getObjectClass():?string;

    /**
     * Indicates the presence of a member method
     * @param string $member
     * @return bool
     */
    function hasMethod(string $member):bool;

    /**
     * Indicated the presence of a member property
     * @param string $member
     * @return bool
     */
    function hasProp(string $member):bool;
}