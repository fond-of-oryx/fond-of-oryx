<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Dependency\Facade;

interface ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeInterface
{
    /**
     * @param array<string> $productConcreteSkus
     *
     * @return array
     */
    public function getBlacklistedLocalesByProductConcreteSkus(array $productConcreteSkus): array;
}
