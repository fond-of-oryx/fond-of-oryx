<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business;

use FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business\Model\CartChecker;
use FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business\Model\CartCheckerInterface;
use FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Dependency\Facade\ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeInterface;
use FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\ProductLocaleRestrictionCartConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ProductLocaleRestrictionCartConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business\Model\CartCheckerInterface
     */
    public function createCartChecker(): CartCheckerInterface
    {
        return new CartChecker($this->getProductLocaleRestrictionFacade());
    }

    /**
     * @return \FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Dependency\Facade\ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeInterface
     */
    protected function getProductLocaleRestrictionFacade(): ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeInterface
    {
        return $this->getProvidedDependency(
            ProductLocaleRestrictionCartConnectorDependencyProvider::FACADE_PRODUCT_LOCALE_RESTRICTION
        );
    }
}
