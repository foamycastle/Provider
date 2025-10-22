<?php

namespace FoamyCastle\Provider;

interface ProviderContract
{
    /**
     * Regenerate the data for which the provider is responsible
     * @param ...$options array required arguments presented as a hash table
     * @return void
     */
    function refresh(...$options): void;
    /**
     * Provide data
     * @param bool $fresh triggers a data refresh if true
     * @param array|mixed ...$options any parameters germaine to the process of data provision
     * @return mixed
     */
    function provide(bool $fresh,...$options):mixed;
}