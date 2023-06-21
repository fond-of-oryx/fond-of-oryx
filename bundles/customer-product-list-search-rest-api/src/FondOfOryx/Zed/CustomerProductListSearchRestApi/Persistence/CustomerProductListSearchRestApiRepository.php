<?php

namespace FondOfOryx\Zed\CustomerProductListSearchRestApi\Persistence;

use Orm\Zed\ProductList\Persistence\Map\SpyProductListTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CustomerProductListSearchRestApi\Persistence\CustomerProductListSearchRestApiPersistenceFactory getFactory()
 */
class CustomerProductListSearchRestApiRepository extends AbstractRepository implements CustomerProductListSearchRestApiRepositoryInterface
{
    /**
     * @param int $idCustomer
     *
     * @return array<int>
     */
    public function getProductListIdsByIdCustomer(int $idCustomer): array
    {
        $productListQuery = $this->getFactory()->getProductListQuery()
            ->clear();

        /** @var array<int> $productListIds */
        $productListIds = $productListQuery->useSpyProductListCustomerQuery()
                ->filterByFkCustomer($idCustomer)
            ->endUse()
            ->select([SpyProductListTableMap::COL_ID_PRODUCT_LIST])
            ->find()
            ->getData();

        return $productListIds;
    }
}
