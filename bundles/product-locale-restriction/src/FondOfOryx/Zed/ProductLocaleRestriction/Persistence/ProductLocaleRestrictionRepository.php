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
    /**
     * @var string
     */
    protected const COLUMN_LOCALE_CODE = 'locale_code';

    /**
     * @param int $idProductAbstract
     *
     * @return array<\Generated\Shared\Transfer\LocaleTransfer>
     */
    public function findBlacklistedLocaleByIdProductAbstract(int $idProductAbstract): array
    {
        $fooProductAbstractLocaleRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractLocaleRestrictionQuery();

        /** @var \Propel\Runtime\Collection\ObjectCollection $fooProductAbstractLocaleRestrictionCollection */
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
     * @return array<int>
     */
    public function findBlacklistedLocaleIdsByIdProductAbstract(int $idProductAbstract): array
    {
        $fooProductAbstractLocaleRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractLocaleRestrictionQuery();

        /** @var \Propel\Runtime\Collection\ArrayCollection $fooProductAbstractLocaleRestrictionCollection */
        $fooProductAbstractLocaleRestrictionCollection = $fooProductAbstractLocaleRestrictionQuery
            ->select(FooProductAbstractLocaleRestrictionTableMap::COL_FK_LOCALE)
            ->filterByFkProductAbstract($idProductAbstract)
            ->find();

        return $fooProductAbstractLocaleRestrictionCollection->toArray();
    }

    /**
     * @param array<int> $idProductAbstracts
     *
     * @return array
     */
    public function findBlacklistedLocalesByProductAbstractIds(array $idProductAbstracts): array
    {
        $fooProductAbstractLocaleRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractLocaleRestrictionQuery();

        /** @var \Propel\Runtime\Collection\ObjectCollection $fooProductAbstractLocaleRestrictionCollection */
        $fooProductAbstractLocaleRestrictionCollection = $fooProductAbstractLocaleRestrictionQuery
            ->filterByFkProductAbstract_In($idProductAbstracts)
            ->innerJoinWithLocale()
            ->find();

        return $this->getFactory()->createProductAbstractLocaleRestrictionMapper()
            ->mapEntityCollectionToGroupedLocaleNames($fooProductAbstractLocaleRestrictionCollection);
    }

    /**
     * @param array<string> $productConcreteSkus
     *
     * @return array
     */
    public function findBlacklistedLocalesByProductConcreteSkus(array $productConcreteSkus): array
    {
        /** @var \Propel\Runtime\Collection\ObjectCollection $fooProductAbstractLocaleRestrictionCollection */
        $fooProductAbstractLocaleRestrictionCollection = $this->getFactory()
            ->createFooProductAbstractLocaleRestrictionQuery()
            ->innerJoinWithLocale()
            ->useProductAbstractQuery()
                ->useSpyProductQuery()
                    ->filterBySku_In($productConcreteSkus)
                    ->withColumn(SpyProductTableMap::COL_SKU, 'sku')
                ->endUse()
            ->endUse()
            ->find();

        return $this->getFactory()->createProductAbstractLocaleRestrictionMapper()
            ->mapEntityCollectionToGroupedLocaleNames($fooProductAbstractLocaleRestrictionCollection, 'sku');
    }
}
