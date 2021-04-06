<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Dependency\Facade;

interface ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeInterface
{
    /**
     * @param string[] $productConcreteSkus
     *
     * @return array
     */
    public function getBlacklistedLocalesByProductConcreteSkus(array $productConcreteSkus): array;
}
