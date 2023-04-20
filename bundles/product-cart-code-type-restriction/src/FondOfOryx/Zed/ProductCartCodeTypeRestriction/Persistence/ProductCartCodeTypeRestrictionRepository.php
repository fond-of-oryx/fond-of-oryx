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
     * @return array<\Generated\Shared\Transfer\CartCodeTypeTransfer>
     */
    public function findBlacklistedCartCodeTypeByIdProductAbstract(
        int $idProductAbstract
    ): array {
        $fooProductAbstractCartCodeTypeRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractCartCodeTypeRestrictionQuery();

        /** @var \Propel\Runtime\Collection\ObjectCollection $fooProductAbstractCartCodeTypeRestrictionCollection */
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
     * @return array<int>
     */
    public function findBlacklistedCartCodeTypeIdsByIdProductAbstract(
        int $idProductAbstract
    ): array {
        $fooProductAbstractCartCodeTypeRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractCartCodeTypeRestrictionQuery();

        /** @var \Propel\Runtime\Collection\ArrayCollection $fooProductAbstractCartCodeTypeRestrictionCollection */
        $fooProductAbstractCartCodeTypeRestrictionCollection = $fooProductAbstractCartCodeTypeRestrictionQuery
            ->select(FooProductAbstractCartCodeTypeRestrictionTableMap::COL_FK_CART_CODE_TYPE)
            ->filterByFkProductAbstract($idProductAbstract)
            ->find();

        return $fooProductAbstractCartCodeTypeRestrictionCollection->toArray();
    }

    /**
     * @param array<string> $productConcreteSkus
     *
     * @return array
     */
    public function findBlacklistedCartCodeTypesByProductConcreteSkus(
        array $productConcreteSkus
    ): array {
        /** @var \Propel\Runtime\Collection\ObjectCollection $fooProductAbstractCartCodeTypeRestrictionCollection */
        $fooProductAbstractCartCodeTypeRestrictionCollection = $this->getFactory()
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
                $fooProductAbstractCartCodeTypeRestrictionCollection,
                'sku',
            );
    }
}
