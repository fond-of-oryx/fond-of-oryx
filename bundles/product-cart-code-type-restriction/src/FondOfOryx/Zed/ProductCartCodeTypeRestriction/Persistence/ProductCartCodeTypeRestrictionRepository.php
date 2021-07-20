<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence;

use Orm\Zed\Product\Persistence\Map\SpyProductTableMap;
use Orm\Zed\ProductCartCodeTypeRestriction\Persistence\Map\FooProductAbstractCartCodeTypeRestrictionTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionPersistenceFactory getFactory()
 */
class ProductCartCodeTypeRestrictionRepository extends AbstractRepository implements ProductCartCodeTypeRestrictionRepositoryInterface
{
    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\CartCodeTypeTransfer[]
     */
    public function findBlacklistedCartCodeTypeByIdProductAbstract(
        int $idProductAbstract
    ): array {
        $fooProductAbstractCartCodeTypeRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractCartCodeTypeRestrictionQuery();

        $fooProductAbstractCartCodeTypeRestrictionCollection = $fooProductAbstractCartCodeTypeRestrictionQuery
            ->filterByFkProductAbstract($idProductAbstract)
            ->innerJoinWithCartCodeType()
            ->find();

        return $this->getFactory()->createProductAbstractCartCodeTypeRestrictionMapper()
            ->mapEntityCollectionToCartCodeTypeTransfers($fooProductAbstractCartCodeTypeRestrictionCollection);
    }

    /**
     * @param int $idProductAbstract
     *
     * @return int[]
     */
    public function findBlacklistedCartCodeTypeIdsByIdProductAbstract(
        int $idProductAbstract
    ): array {
        $fooProductAbstractCartCodeTypeRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractCartCodeTypeRestrictionQuery();

        return $fooProductAbstractCartCodeTypeRestrictionQuery
            ->select(FooProductAbstractCartCodeTypeRestrictionTableMap::COL_FK_CART_CODE_TYPE)
            ->findByFkProductAbstract($idProductAbstract)
            ->toArray();
    }

    /**
     * @param string[] $productConcreteSkus
     *
     * @return array
     */
    public function findBlacklistedCartCodeTypesByProductConcreteSkus(
        array $productConcreteSkus
    ): array {
        /** @var \Orm\Zed\ProductCartCodeTypeRestriction\Persistence\FooProductAbstractCartCodeTypeRestrictionQuery $fooProductAbstractCartCodeTypeRestrictionQuery */
        $fooProductAbstractCartCodeTypeRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractCartCodeTypeRestrictionQuery()
            ->innerJoinWithCartCodeType()
            ->useProductAbstractQuery()
                ->useSpyProductQuery()
                    ->filterBySku_In($productConcreteSkus)
                    ->withColumn(SpyProductTableMap::COL_SKU, 'sku')
                ->endUse()
            ->endUse();

        return $this->getFactory()->createProductAbstractCartCodeTypeRestrictionMapper()
            ->mapEntityCollectionToGroupedCartCodeTypeNames(
                $fooProductAbstractCartCodeTypeRestrictionQuery->find(),
                'sku'
            );
    }
}
