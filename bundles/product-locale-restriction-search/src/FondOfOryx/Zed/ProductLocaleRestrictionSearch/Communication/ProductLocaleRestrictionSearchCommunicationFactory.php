<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionSearch\Communication;

use FondOfOryx\Zed\ProductLocaleRestrictionSearch\Dependency\Facade\ProductLocaleRestrictionSearchToProductLocaleRestrictionFacadeInterface;
use FondOfOryx\Zed\ProductLocaleRestrictionSearch\ProductLocaleRestrictionSearchDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class ProductLocaleRestrictionSearchCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\ProductLocaleRestrictionSearch\Dependency\Facade\ProductLocaleRestrictionSearchToProductLocaleRestrictionFacadeInterface
     */
    public function getProductLocaleRestrictionFacade(): ProductLocaleRestrictionSearchToProductLocaleRestrictionFacadeInterface
    {
        return $this->getProvidedDependency(
            ProductLocaleRestrictionSearchDependencyProvider::FACADE_PRODUCT_LOCALE_RESTRICTION
        );
    }
}
