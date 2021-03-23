<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionSearch\Dependency\Facade;

interface ProductLocaleRestrictionSearchToProductLocaleRestrictionFacadeInterface
{
    /**
     * @param int[] $productAbstractIds
     *
     * @return array
     */
    public function getBlacklistedLocalesByProductAbstractIds(array $productAbstractIds): array;
}
