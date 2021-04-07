<?php

namespace FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector;

use FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\Dependency\Client\ProductCountryRestrictionCheckoutConnectorToZedRequestClientInterface;
use FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\Zed\ProductCountryRestrictionCheckoutConnectorStub;
use FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\Zed\ProductCountryRestrictionCheckoutConnectorStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class ProductCountryRestrictionCheckoutConnectorFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\Zed\ProductCountryRestrictionCheckoutConnectorStubInterface
     */
    public function createProductCountryRestrictionCheckoutConnectorZedStub(): ProductCountryRestrictionCheckoutConnectorStubInterface
    {
        return new ProductCountryRestrictionCheckoutConnectorStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\Dependency\Client\ProductCountryRestrictionCheckoutConnectorToZedRequestClientInterface
     */
    public function getZedRequestClient(): ProductCountryRestrictionCheckoutConnectorToZedRequestClientInterface
    {
        return $this->getProvidedDependency(ProductCountryRestrictionCheckoutConnectorDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
