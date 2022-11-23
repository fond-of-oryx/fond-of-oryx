<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Persistence;

use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListCustomerTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiPersistenceFactory getFactory()
 */
class CustomerProductListsRestApiRepository extends AbstractRepository implements CustomerProductListsRestApiRepositoryInterface
{
     /**
      * @param int $idProductList
      * @param int $idCustomer
      *
      * @return bool
      */
    public function hasProductListByIdProductListAndIdCustomer(int $idProductList, int $idCustomer): bool
    {
        return $this->getFactory()
            ->getProductListCustomerQuery()
            ->clear()
            ->filterByFkProductList($idProductList)
            ->filterByFkCustomer($idCustomer)
            ->exists();
    }

    /**
     * @param array<string> $customerReferences
     *
     * @return array<int>
     */
    public function getCustomerIdsByCustomerReferences(
        array $customerReferences
    ): array {
        return $this->getFactory()
            ->getCustomerQuery()
            ->clear()
            ->filterByCustomerReference_In($customerReferences)
            ->select([SpyCustomerTableMap::COL_ID_CUSTOMER])
            ->find()
            ->toArray();
    }

    /**
     * @param int $idProductList
     *
     * @return array<int>
     */
    public function getCustomerIdsByIdProductList(int $idProductList): array
    {
        return $this->getFactory()
            ->getProductListCustomerQuery()
            ->clear()
            ->filterByFkProductList($idProductList)
            ->select([SpyProductListCustomerTableMap::COL_FK_CUSTOMER])
            ->find()
            ->toArray();
    }
}
