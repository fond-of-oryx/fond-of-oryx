<?php

namespace FondOfOryx\Yves\AvailabilityAlert\Dependency\Client;

use Generated\Shared\Transfer\StoreTransfer;
use Spryker\Client\Store\StoreClientInterface;

class AvailabilityAlertToStoreClientBridge implements AvailabilityAlertToStoreClientInterface
{
    /**
     * @var \Spryker\Client\Store\StoreClientInterface
     */
    protected $client;

    /**
     * @param \Spryker\Client\Store\StoreClientInterface $storeClient
     */
    public function __construct(StoreClientInterface $storeClient)
    {
        $this->client = $storeClient;
    }

    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer
    {
        return $this->client->getCurrentStore();
    }
}
