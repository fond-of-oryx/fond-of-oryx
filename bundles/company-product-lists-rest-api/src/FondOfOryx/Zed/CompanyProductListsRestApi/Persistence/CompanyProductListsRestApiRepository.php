<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Persistence;

use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListCompanyTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiPersistenceFactory getFactory()
 */
class CompanyProductListsRestApiRepository extends AbstractRepository implements CompanyProductListsRestApiRepositoryInterface
{
     /**
      * @param array<string> $companyUuids
      * @param int $idCustomer
      *
      * @return array<int>
      */
    public function getCompanyIdsByCompanyUuidsAndIdCustomer(array $companyUuids, int $idCustomer): array
    {
        /** @var \Propel\Runtime\Collection\ArrayCollection $spyCompanyUserCollection */
        $spyCompanyUserCollection = $this->getFactory()->getCompanyQuery()//@phpstan-ignore-line
            ->useCompanyUserQuery()
                ->filterByFkCustomer($idCustomer)
                ->filterByIsActive(true)
                ->useCustomerQuery()
                    ->filterByAnonymizedAt(null, Criteria::ISNULL)
                ->endUse()
            ->endUse()
            ->filterByIsActive(true)
            ->filterByUuid_In($companyUuids)
            ->select([SpyCompanyTableMap::COL_ID_COMPANY])
            ->find();

        return $spyCompanyUserCollection->toArray();
    }

    /**
     * @param int $idProductList
     *
     * @return array<int>
     */
    public function getCompanyIdsByIdProductList(int $idProductList): array
    {
        /** @var \Propel\Runtime\Collection\ArrayCollection $productListCompanyCollection */
        $productListCompanyCollection = $this->getFactory()
            ->getProductListCompanyQuery()
            ->clear()
            ->filterByFkProductList($idProductList)
            ->select([SpyProductListCompanyTableMap::COL_FK_COMPANY])
            ->find();

        return $productListCompanyCollection->toArray();
    }
}
