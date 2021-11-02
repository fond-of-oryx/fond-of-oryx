<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionCartConnector;

use FondOfOryx\Client\ProductLocaleRestrictionCartConnector\Dependency\Client\ProductLocaleRestrictionCartConnectorToLocaleClientInterface;
use Spryker\Client\Kernel\AbstractFactory;

class ProductLocaleRestrictionCartConnectorFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\ProductLocaleRestrictionCartConnector\Dependency\Client\ProductLocaleRestrictionCartConnectorToLocaleClientInterface
     */
    public function getLocaleClient(): ProductLocaleRestrictionCartConnectorToLocaleClientInterface
    {
        return $this->getProvidedDependency(
            ProductLocaleRestrictionCartConnectorDependencyProvider::CLIENT_LOCALE,
        );
    }
}
