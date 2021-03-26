<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade;

interface ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeInterface
{
    /**
     * @param int[] $productAbstractIds
     *
     * @return array
     */
    public function getBlacklistedLocalesByProductAbstractIds(array $productAbstractIds): array;
}
