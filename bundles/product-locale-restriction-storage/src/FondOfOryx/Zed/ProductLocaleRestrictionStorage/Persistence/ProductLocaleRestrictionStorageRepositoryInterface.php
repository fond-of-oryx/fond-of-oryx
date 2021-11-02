<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Persistence;

use Generated\Shared\Transfer\FilterTransfer;

interface ProductLocaleRestrictionStorageRepositoryInterface
{
    /**
     * @param array<int> $productAbstractIds
     *
     * @return array<\Orm\Zed\ProductLocaleRestrictionStorage\Persistence\FooProductAbstractLocaleRestrictionStorage>
     */
    public function findProductAbstractLocaleRestrictionStorageEntitiesByProductAbstractIds(
        array $productAbstractIds
    ): array;

    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     * @param array<int> $productAbstractIds
     *
     * @return array<\Generated\Shared\Transfer\FooProductAbstractLocaleRestrictionStorageEntityTransfer>
     */
    public function findFilteredProductAbstractLocaleRestrictionStorageEntities(
        FilterTransfer $filterTransfer,
        array $productAbstractIds = []
    ): array;
}
