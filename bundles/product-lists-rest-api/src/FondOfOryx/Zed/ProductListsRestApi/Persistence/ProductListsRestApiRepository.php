<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Persistence;

use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
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
            ->select([SpyCustomerTableMap::COL_ID_CUSTOMER])
            ->findOne();

        return $idProductList;
    }
}
