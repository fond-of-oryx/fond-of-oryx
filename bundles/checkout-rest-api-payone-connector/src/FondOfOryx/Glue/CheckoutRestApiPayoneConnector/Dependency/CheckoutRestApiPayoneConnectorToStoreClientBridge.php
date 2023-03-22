<?php

namespace FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Dependency;

use Spryker\Client\Store\StoreClientInterface;

class CheckoutRestApiPayoneConnectorToStoreClientBridge implements CheckoutRestApiPayoneConnectorToStoreClientBridgeInterface
{
    /**
     * @var \Spryker\Client\Store\StoreClientInterface
     */
    private $storeClient;

    /**
     * @param \Spryker\Client\Store\StoreClientInterface $storeClient
     */
    public function __construct(StoreClientInterface $storeClient)
    {
        $this->storeClient = $storeClient;
    }

    /**
     * @return string
     */
    public function getCurrencyIsoCode(): string
    {
        return $this->storeClient->getCurrentStore()->getSelectedCurrencyIsoCode();
    }
}
