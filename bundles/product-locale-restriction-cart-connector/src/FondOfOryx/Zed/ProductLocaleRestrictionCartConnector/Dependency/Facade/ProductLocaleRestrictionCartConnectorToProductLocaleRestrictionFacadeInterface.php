<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Dependency\Facade;

interface ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeInterface
{
    /**
     * @param int[] $productAbstractIds
     *
     * @return array
     */
    public function getBlacklistedLocalesByProductAbstractIds(array $productAbstractIds): array;
}
