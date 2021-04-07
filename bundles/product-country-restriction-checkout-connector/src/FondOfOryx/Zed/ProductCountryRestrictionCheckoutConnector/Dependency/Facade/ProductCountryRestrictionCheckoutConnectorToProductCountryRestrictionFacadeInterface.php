<?php

namespace FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Dependency\Facade;

interface ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeInterface
{
    /**
     * @param string[] $productConcreteSkus
     *
     * @return array
     */
    public function getBlacklistedCountriesByProductConcreteSkus(array $productConcreteSkus): array;
}
