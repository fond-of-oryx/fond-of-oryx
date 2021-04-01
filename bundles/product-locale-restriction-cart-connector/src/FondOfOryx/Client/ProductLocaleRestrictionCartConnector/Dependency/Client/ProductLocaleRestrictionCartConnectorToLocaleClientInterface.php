<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionCartConnector\Dependency\Client;

interface ProductLocaleRestrictionCartConnectorToLocaleClientInterface
{
    /**
     * @return string
     */
    public function getCurrentLocale(): string;
}
