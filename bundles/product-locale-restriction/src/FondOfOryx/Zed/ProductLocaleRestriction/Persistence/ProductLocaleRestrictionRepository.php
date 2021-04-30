<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Persistence;

use Orm\Zed\Product\Persistence\Map\SpyProductTableMap;
use Orm\Zed\ProductLocaleRestriction\Persistence\Map\FooProductAbstractLocaleRestrictionTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionPersistenceFactory getFactory()
 */
class ProductLocaleRestrictionRepository extends AbstractRepository implements ProductLocaleRestrictionRepositoryInterface
{
    protected const COLUMN_LOCALE_CODE = 'locale_code';

    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer[]
     */
    public function findBlacklistedLocaleByIdProductAbstract(int $idProductAbstract): array
    {
        $fooProductAbstractLocaleRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractLocaleRestrictionQuery();

        $fooProductAbstractLocaleRestrictionCollection = $fooProductAbstractLocaleRestrictionQuery
            ->filterByFkProductAbstract($idProductAbstract)
            ->innerJoinWithLocale()
            ->find();

        return $this->getFactory()->createProductAbstractLocaleRestrictionMapper()
            ->mapEntityCollectionToLocaleTransfers($fooProductAbstractLocaleRestrictionCollection);
    }

    /**
     * @param int $idProductAbstract
     *
     * @return int[]
     */
    public function findBlacklistedLocaleIdsByIdProductAbstract(int $idProductAbstract): array
    {
        $fooProductAbstractLocaleRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractLocaleRestrictionQuery();

        return $fooProductAbstractLocaleRestrictionQuery
            ->select(FooProductAbstractLocaleRestrictionTableMap::COL_FK_LOCALE)
            ->findByFkProductAbstract($idProductAbstract)
            ->toArray();
    }

    /**
     * @param int[] $idProductAbstracts
     *
     * @return array
     */
    public function findBlacklistedLocalesByProductAbstractIds(array $idProductAbstracts): array
    {
        $fooProductAbstractLocaleRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractLocaleRestrictionQuery();

        $fooProductAbstractLocaleRestrictionCollection = $fooProductAbstractLocaleRestrictionQuery
            ->filterByFkProductAbstract_In($idProductAbstracts)
            ->innerJoinWithLocale()
            ->find();

        return $this->getFactory()->createProductAbstractLocaleRestrictionMapper()
            ->mapEntityCollectionToGroupedLocaleNames($fooProductAbstractLocaleRestrictionCollection);
    }

    /**
     * @param string[] $productConcreteSkus
     *
     * @return array
     */
    public function findBlacklistedLocalesByProductConcreteSkus(array $productConcreteSkus): array
    {
        /** @var \Orm\Zed\ProductLocaleRestriction\Persistence\FooProductAbstractLocaleRestrictionQuery $fooProductAbstractLocaleRestrictionQuery */
        $fooProductAbstractLocaleRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractLocaleRestrictionQuery()
            ->innerJoinWithLocale()
            ->useProductAbstractQuery()
                ->useSpyProductQuery()
                    ->filterBySku_In($productConcreteSkus)
                    ->withColumn(SpyProductTableMap::COL_SKU, 'sku')
                ->endUse()
            ->endUse();

        return $this->getFactory()->createProductAbstractLocaleRestrictionMapper()
            ->mapEntityCollectionToGroupedLocaleNames($fooProductAbstractLocaleRestrictionQuery->find(), 'sku');
    }
}
