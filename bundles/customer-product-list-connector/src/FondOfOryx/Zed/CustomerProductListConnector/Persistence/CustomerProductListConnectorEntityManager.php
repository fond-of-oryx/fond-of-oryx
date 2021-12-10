<?php

namespace FondOfOryx\Zed\CustomerProductListConnector\Persistence;

use Orm\Zed\ProductList\Persistence\SpyProductListCustomer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorPersistenceFactory getFactory()
 */
class CustomerProductListConnectorEntityManager extends AbstractEntityManager implements CustomerProductListConnectorEntityManagerInterface
{
    /**
     * @param array<int> $productListIds
     * @param int $idCustomer
     *
     * @return void
     */
    public function assignProductListsToCustomer(array $productListIds, int $idCustomer): void
    {
        foreach ($productListIds as $idProductList) {
            (new SpyProductListCustomer())->setFkCustomer($idCustomer)
                ->setFkProductList($idProductList)
                ->save();
        }
    }

    /**
     * @param array<int> $productListIds
     * @param int $idCustomer
     *
     * @return void
     */
    public function deAssignProductListsFromCustomer(array $productListIds, int $idCustomer): void
    {
        $entities = $this->getFactory()
            ->getProductListCustomerQuery()
            ->clear()
            ->filterByFkCustomer($idCustomer)
            ->filterByFkProductList_In($productListIds)
            ->find();

        foreach ($entities as $entity) {
            $entity->delete();
        }
    }
}
