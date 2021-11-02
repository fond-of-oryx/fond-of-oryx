<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade;

interface ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeInterface
{
    /**
     * @param array<int> $productAbstractIds
     *
     * @return array
     */
    public function getBlacklistedLocalesByProductAbstractIds(array $productAbstractIds): array;
}
