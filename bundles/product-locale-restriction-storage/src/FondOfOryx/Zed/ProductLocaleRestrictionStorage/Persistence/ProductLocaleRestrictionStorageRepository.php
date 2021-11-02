<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Persistence;

use Generated\Shared\Transfer\FilterTransfer;
use Orm\Zed\ProductLocaleRestrictionStorage\Persistence\Map\FooProductAbstractLocaleRestrictionStorageTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Persistence\ProductLocaleRestrictionStoragePersistenceFactory getFactory()
 */
class ProductLocaleRestrictionStorageRepository extends AbstractRepository implements ProductLocaleRestrictionStorageRepositoryInterface
{
    /**
     * @param array<int> $productAbstractIds
     *
     * @return array<\Orm\Zed\ProductLocaleRestrictionStorage\Persistence\FooProductAbstractLocaleRestrictionStorage>
     */
    public function findProductAbstractLocaleRestrictionStorageEntitiesByProductAbstractIds(
        array $productAbstractIds
    ): array {
        $keyColumn = FooProductAbstractLocaleRestrictionStorageTableMap::getTableMap()
            ->getColumn(FooProductAbstractLocaleRestrictionStorageTableMap::COL_FK_PRODUCT_ABSTRACT)
            ->getPhpName();

        return $this->getFactory()
            ->createFooProductAbstractLocaleRestrictionStorageQuery()
            ->filterByFkProductAbstract_In($productAbstractIds)
            ->find()
            ->toKeyIndex($keyColumn);
    }

    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     * @param array<int> $productAbstractIds
     *
     * @return array<\Generated\Shared\Transfer\FooProductAbstractLocaleRestrictionStorageEntityTransfer>
     */
    public function findFilteredProductAbstractLocaleRestrictionStorageEntities(
        FilterTransfer $filterTransfer,
        array $productAbstractIds = []
    ): array {
        $query = $this->getFactory()
            ->createFooProductAbstractLocaleRestrictionStorageQuery();

        if ($productAbstractIds) {
            $query->filterByFkProductAbstract_In($productAbstractIds);
        }

        return $this->buildQueryFromCriteria($query, $filterTransfer)->find();
    }
}
