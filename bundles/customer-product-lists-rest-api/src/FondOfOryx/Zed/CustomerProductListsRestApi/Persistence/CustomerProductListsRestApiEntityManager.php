<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Persistence;

use Orm\Zed\ProductList\Persistence\SpyProductListCustomer as OrmSpyProductListCustomer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiPersistenceFactory getFactory()
 */
class CustomerProductListsRestApiEntityManager extends AbstractEntityManager implements CustomerProductListsRestApiEntityManagerInterface
{
    /**
     * @param array $customerIdsToAssign
     * @param int $idProductList
     *
     * @return void
     */
    public function assignCustomersToProductList(array $customerIdsToAssign, int $idProductList): void
    {
        foreach ($customerIdsToAssign as $customerIdToAssign) {
            (new OrmSpyProductListCustomer())->setFkCustomer($customerIdToAssign)
                ->setFkProductList($idProductList)
                ->save();
        }
    }

    /**
     * @param array $customerIdsToDeassign
     * @param int $idProductList
     *
     * @return void
     */
    public function deassignCustomersFromProductList(array $customerIdsToDeassign, int $idProductList): void
    {
        $relations = $this->getFactory()->getProductListCustomerQuery()
            ->clear()
            ->filterByFkProductList($idProductList)
            ->filterByFkCustomer_In($customerIdsToDeassign)
            ->find();

        foreach ($relations as $relation) {
            $relation->delete();
        }
    }
}
