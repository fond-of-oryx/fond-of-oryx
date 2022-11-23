<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Persistence;

use Orm\Zed\ProductList\Persistence\Map\SpyProductListTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\ProductListsRestApi\Persistence\ProductListsRestApiPersistenceFactory getFactory()
 */
class ProductListsRestApiRepository extends AbstractRepository implements ProductListsRestApiRepositoryInterface
{
    /**
     * @param string $uuid
     *
     * @return int|null
     */
    public function getIdProductListByUuid(string $uuid): ?int
    {
        /** @var int|null $idProductList */
        $idProductList = $this->getFactory()
            ->getProductListQuery()
            ->clear()
            ->filterByUuid($uuid)
            ->select([SpyProductListTableMap::COL_ID_PRODUCT_LIST])
            ->findOne();

        return $idProductList;
    }
}
