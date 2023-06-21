<?php

namespace FondOfOryx\Zed\BrandProductListConnector\Persistence;

use Orm\Zed\BrandProduct\Persistence\Map\FosBrandProductTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\BrandProductListConnector\Persistence\BrandProductListConnectorPersistenceFactory getFactory()
 */
class BrandProductListConnectorRepository extends AbstractRepository implements BrandProductListConnectorRepositoryInterface
{
    /**
     * @param array<int> $productListIds
     *
     * @return array<int>
     */
    public function getBrandIdsByProductListIds(array $productListIds): array
    {
        /** @var \Propel\Runtime\Collection\ArrayCollection $fosBrandProductCollection */
        $fosBrandProductCollection = $this->getFactory()
            ->getBrandProductQuery()
            ->clear()
            ->useSpyProductAbstractQuery()
                ->useSpyProductQuery()
                    ->useSpyProductListProductConcreteQuery()
                        ->filterByFkProductList_In($productListIds)
                    ->endUse()
                ->endUse()
            ->endUse()
            ->groupByFkBrand()
            ->select([FosBrandProductTableMap::COL_FK_BRAND])
            ->find();

        return $fosBrandProductCollection->toArray();
    }
}
