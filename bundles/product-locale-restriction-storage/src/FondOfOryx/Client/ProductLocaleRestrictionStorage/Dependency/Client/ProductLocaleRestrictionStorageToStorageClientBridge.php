<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client;

use Spryker\Client\Storage\StorageClientInterface;

class ProductLocaleRestrictionStorageToStorageClientBridge implements
    ProductLocaleRestrictionStorageToStorageClientInterface
{
    /**
     * @var \Spryker\Client\Storage\StorageClientInterface
     */
    protected $storageClient;

    /**
     * @param \Spryker\Client\Storage\StorageClientInterface $storageClient
     */
    public function __construct(StorageClientInterface $storageClient)
    {
        $this->storageClient = $storageClient;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->storageClient->get($key);
    }

    /**
     * @param array<string> $keys
     *
     * @return array
     */
    public function getMulti(array $keys): array
    {
        return $this->storageClient->getMulti($keys);
    }
}
