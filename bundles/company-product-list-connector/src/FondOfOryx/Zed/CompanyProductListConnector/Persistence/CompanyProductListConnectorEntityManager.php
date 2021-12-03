<?php

namespace FondOfOryx\Zed\CompanyProductListConnector\Persistence;

use Orm\Zed\ProductList\Persistence\SpyProductListCompany;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorPersistenceFactory getFactory()
 */
class CompanyProductListConnectorEntityManager extends AbstractEntityManager implements CompanyProductListConnectorEntityManagerInterface
{
    /**
     * @param array<int> $productListIds
     * @param int $idCompany
     *
     * @return void
     */
    public function assignProductListsToCompany(array $productListIds, int $idCompany): void
    {
        foreach ($productListIds as $idProductList) {
            (new SpyProductListCompany())->setFkCompany($idCompany)
                ->setFkProductList($idProductList)
                ->save();
        }
    }

    /**
     * @param array<int> $productListIds
     * @param int $idCompany
     *
     * @return void
     */
    public function deAssignProductListsFromCompany(array $productListIds, int $idCompany): void
    {
        $entities = $this->getFactory()
            ->getProductListCompanyQuery()
            ->clear()
            ->filterByFkCompany($idCompany)
            ->filterByFkProductList_In($productListIds)
            ->find();

        foreach ($entities as $entity) {
            $entity->delete();
        }
    }
}
