<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionSearch;

use FondOfOryx\Client\ProductLocaleRestrictionSearch\Dependency\Client\ProductLocaleRestrictionSearchToLocaleClientInterface;
use Spryker\Client\Kernel\AbstractFactory;

class ProductLocaleRestrictionSearchFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\ProductLocaleRestrictionSearch\Dependency\Client\ProductLocaleRestrictionSearchToLocaleClientInterface
     */
    public function getLocaleClient(): ProductLocaleRestrictionSearchToLocaleClientInterface
    {
        return $this->getProvidedDependency(ProductLocaleRestrictionSearchDependencyProvider::CLIENT_LOCALE);
    }
}
