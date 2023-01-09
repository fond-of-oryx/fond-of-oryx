<?php

namespace FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Dependency;

interface CheckoutRestApiPayoneConnectorToStoreClientBridgeInterface
{
    /**
     * @return string
     */
    public function getCurrencyIsoCode(): string;
}
