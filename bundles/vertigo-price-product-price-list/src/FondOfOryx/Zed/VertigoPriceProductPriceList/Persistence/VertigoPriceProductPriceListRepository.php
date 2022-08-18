<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Persistence;

use Orm\Zed\PriceProductPriceList\Persistence\Map\FosPriceProductPriceListTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\VertigoPriceProductPriceList\Persistence\VertigoPriceProductPriceListPersistenceFactory getFactory()
 */
class VertigoPriceProductPriceListRepository extends AbstractRepository implements VertigoPriceProductPriceListRepositoryInterface
{
    /**
     * @return array<string>
     */
    public function getSkusWithoutPriceProductPriceList(): array
    {
        return $this->getFactory()
            ->getProductQuery()
            ->clear()
            ->select([SpyProductTableMap::COL_SKU])
            ->where(
                sprintf(
                    '%s NOT IN (SELECT %s FROM %s WHERE %s IS NOT NULL GROUP BY %s)',
                    SpyProductTableMap::COL_ID_PRODUCT,
                    FosPriceProductPriceListTableMap::COL_FK_PRODUCT,
                    FosPriceProductPriceListTableMap::TABLE_NAME,
                    FosPriceProductPriceListTableMap::COL_FK_PRODUCT,
                    FosPriceProductPriceListTableMap::COL_FK_PRODUCT,
                ),
            )->find()
            ->toArray();
    }

    /**
     * @param string $sku
     *
     * @return bool
     */
    public function hasPriceProductPriceList(string $sku): bool
    {
         return $this->getFactory()
             ->getProductQuery()
             ->clear()
             ->filterBySku($sku)
             ->where(
                 sprintf(
                     '%s IN (SELECT %s FROM %s WHERE %s IS NOT NULL GROUP BY %s)',
                     SpyProductTableMap::COL_ID_PRODUCT,
                     FosPriceProductPriceListTableMap::COL_FK_PRODUCT,
                     FosPriceProductPriceListTableMap::TABLE_NAME,
                     FosPriceProductPriceListTableMap::COL_FK_PRODUCT,
                     FosPriceProductPriceListTableMap::COL_FK_PRODUCT,
                 ),
             )->find()
             ->count() > 0;
    }
}
