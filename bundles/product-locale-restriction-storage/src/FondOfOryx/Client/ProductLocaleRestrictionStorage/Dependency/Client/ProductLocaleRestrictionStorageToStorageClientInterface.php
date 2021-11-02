<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client;

interface ProductLocaleRestrictionStorageToStorageClientInterface
{
    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key);

    /**
     * @param array<string> $keys
     *
     * @return array
     */
    public function getMulti(array $keys): array;
}
