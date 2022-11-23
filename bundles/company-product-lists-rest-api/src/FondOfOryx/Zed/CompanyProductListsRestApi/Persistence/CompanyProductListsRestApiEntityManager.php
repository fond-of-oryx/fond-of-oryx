<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Persistence;

use Orm\Zed\ProductList\Persistence\SpyProductListCompany;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiPersistenceFactory getFactory()
 */
class CompanyProductListsRestApiEntityManager extends AbstractEntityManager implements CompanyProductListsRestApiEntityManagerInterface
{
     /**
      * @param array<int> $companyIdsToAssign
      * @param int $idProductList
      *
      * @return void
      */
    public function assignCompaniesToProductList(array $companyIdsToAssign, int $idProductList): void
    {
        foreach ($companyIdsToAssign as $companyIdToAssign) {
            (new SpyProductListCompany())->setFkCompany($companyIdToAssign)
                ->setFkProductList($idProductList)
                ->save();
        }
    }

    /**
     * @param array<int> $companyIdsToDeassign
     * @param int $idProductList
     *
     * @return void
     */
    public function deassignCompaniesFromProductList(array $companyIdsToDeassign, int $idProductList): void
    {
        $relations = $this->getFactory()->getProductListCompanyQuery()
            ->clear()
            ->filterByFkProductList($idProductList)
            ->filterByFkCompany_In($companyIdsToDeassign)
            ->find();

        foreach ($relations as $relation) {
            $relation->delete();
        }
    }
}
