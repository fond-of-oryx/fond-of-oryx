<?php

namespace FondOfOryx\Zed\InactiveQuoteItemFilter\Persistence;

use Orm\Zed\Product\Persistence\Map\SpyProductTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\InactiveQuoteItemFilter\Persistence\InactiveQuoteItemFilterPersistenceFactory getFactory()
 */
class InactiveQuoteItemFilterRepository extends AbstractRepository implements InactiveQuoteItemFilterRepositoryInterface
{
    /**
     * @param string $storeName
     * @param array $skus
     *
     * @return array
     */
    public function getActiveSkusByStoreNameAndSkus(string $storeName, array $skus): array
    {
        /** @var \Propel\Runtime\Collection\ArrayCollection $collection */
        $collection = $this->getFactory()
            ->getProductQuery()
            ->clear()
            ->filterBySku_In($skus)
            ->filterByIsActive(true)
            ->useSpyProductAbstractQuery()
                ->useSpyProductAbstractStoreQuery()
                    ->useSpyStoreQuery()
                        ->filterByName($storeName)
                    ->endUse()
                ->endUse()
            ->endUse()
            ->select([SpyProductTableMap::COL_SKU])
            ->find();

        return $collection->toArray();
    }
}
