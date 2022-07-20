<?php

namespace FondOfOryx\Zed\ProductCountryRestriction\Persistence;

use Orm\Zed\Product\Persistence\Map\SpyProductTableMap;
use Orm\Zed\ProductCountryRestriction\Persistence\Map\FooProductAbstractCountryRestrictionTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionPersistenceFactory getFactory()
 */
class ProductCountryRestrictionRepository extends AbstractRepository implements ProductCountryRestrictionRepositoryInterface
{
    /**
     * @var string
     */
    protected const COLUMN_COUNTRY_CODE = 'country_code';

    /**
     * @param int $idProductAbstract
     *
     * @return array<\Generated\Shared\Transfer\CountryTransfer>
     */
    public function findBlacklistedCountryByIdProductAbstract(
        int $idProductAbstract
    ): array {
        $fooProductAbstractCountryRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractCountryRestrictionQuery();

        $fooProductAbstractCountryRestrictionCollection = $fooProductAbstractCountryRestrictionQuery
            ->filterByFkProductAbstract($idProductAbstract)
            ->innerJoinWithCountry()
            ->find();

        return $this->getFactory()->createProductAbstractCountryRestrictionMapper()
            ->mapEntityCollectionToCountryTransfers($fooProductAbstractCountryRestrictionCollection);
    }

    /**
     * @param int $idProductAbstract
     *
     * @return array<int>
     */
    public function findBlacklistedCountryIdsByIdProductAbstract(
        int $idProductAbstract
    ): array {
        $fooProductAbstractCountryRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractCountryRestrictionQuery();

        return $fooProductAbstractCountryRestrictionQuery
            ->select(FooProductAbstractCountryRestrictionTableMap::COL_FK_COUNTRY)
            ->filterByFkProductAbstract($idProductAbstract)
            ->find()
            ->toArray();
    }

    /**
     * @param array<string> $productConcreteSkus
     *
     * @return array
     */
    public function findBlacklistedCountriesByProductConcreteSkus(
        array $productConcreteSkus
    ): array {
        /** @var \Orm\Zed\ProductCountryRestriction\Persistence\FooProductAbstractCountryRestrictionQuery $fooProductAbstractCountryRestrictionQuery */
        $fooProductAbstractCountryRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractCountryRestrictionQuery()
            ->innerJoinWithCountry()
            ->useProductAbstractQuery()
                ->useSpyProductQuery()
                    ->filterBySku_In($productConcreteSkus)
                    ->withColumn(SpyProductTableMap::COL_SKU, 'sku')
                ->endUse()
            ->endUse();

        return $this->getFactory()->createProductAbstractCountryRestrictionMapper()
            ->mapEntityCollectionToGroupedCountryNames($fooProductAbstractCountryRestrictionQuery->find(), 'sku');
    }
}
