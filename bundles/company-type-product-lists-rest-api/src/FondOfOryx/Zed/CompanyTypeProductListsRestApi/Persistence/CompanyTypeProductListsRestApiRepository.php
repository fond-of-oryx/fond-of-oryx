<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Persistence;

use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Communication\Plugin\PermissionExtension\CanAssignProductListToCompanyPermissionPlugin;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Communication\Plugin\PermissionExtension\CanAssignProductListToCustomerPermissionPlugin;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Persistence\CompanyTypeProductListsRestApiPersistenceFactory getFactory()
 */
class CompanyTypeProductListsRestApiRepository extends AbstractRepository implements CompanyTypeProductListsRestApiRepositoryInterface
{
    /**
     * @param int $currentIdCustomer
     * @param array<string> $customerReferences
     *
     * @return array<int>
     */
    public function getAuthorizedCompanyUserIdsByCurrentIdCustomerAndCustomerReferences(
        int $currentIdCustomer,
        array $customerReferences
    ): array {
        return $this->getFactory()
            ->getCompanyUserQuery()
            ->clear()
            ->useCustomerQuery()
                ->filterByAnonymizedAt(null, Criteria::ISNULL)
                ->filterByIdCustomer($currentIdCustomer)
            ->endUse()
            ->useSpyCompanyRoleToCompanyUserQuery()
                ->useCompanyRoleQuery()
                    ->useSpyCompanyRoleToPermissionQuery()
                        ->usePermissionQuery()
                            ->filterByKey(CanAssignProductListToCustomerPermissionPlugin::KEY)
                        ->endUse()
                    ->endUse()
                ->endUse()
            ->endUse()
            ->useCompanyQuery()
                ->useCompanyUserQuery('xxx')
                    ->useCustomerQuery('yyy')
                        ->filterByAnonymizedAt(null, Criteria::ISNULL)
                        ->filterByCustomerReference_In($customerReferences)
                    ->endUse()
                    ->filterByIsActive(true)
                ->endUse()
                ->filterByIsActive(true)
                ->filterByFkCompanyType(2)
            ->endUse()
            ->select([SpyCompanyUserTableMap::COL_ID_COMPANY_USER])
            ->find()
            ->toArray();
    }

    /**
     * @param array<int> $companyUserIds
     *
     * @return array<string>
     */
    public function getWhitelistedCustomerReferencesByCompanyUserIds(array $companyUserIds): array
    {
        return $this->getFactory()
            ->getCustomerQuery()
            ->clear()
            ->useCompanyUserQuery()
                ->useCompanyQuery()
                    ->filterByIsActive(true)
                    ->filterByFkCompanyType(2)
                    ->useCompanyUserQuery('xxx')
                        ->filterByIdCompanyUser_In($companyUserIds)
                    ->endUse()
                ->endUse()
                ->filterByIsActive(true)
            ->endUse()
            ->filterByAnonymizedAt(null, Criteria::ISNULL)
            ->groupByCustomerReference()
            ->select([SpyCustomerTableMap::COL_CUSTOMER_REFERENCE])
            ->find()
            ->toArray();
    }

    /**
     * @param int $currentIdCustomer
     * @param array $companyUuids
     *
     * @return array<int>
     */
    public function getAuthorizedCompanyUserIdsByCurrentIdCustomerAndCompanyUuids(
        int $currentIdCustomer,
        array $companyUuids
    ): array {
        return $this->getFactory()
            ->getCompanyUserQuery()
            ->clear()
            ->useCustomerQuery()
                ->filterByAnonymizedAt(null, Criteria::ISNULL)
                ->filterByIdCustomer($currentIdCustomer)
            ->endUse()
            ->useSpyCompanyRoleToCompanyUserQuery()
                ->useCompanyRoleQuery()
                    ->useSpyCompanyRoleToPermissionQuery()
                        ->usePermissionQuery()
                            ->filterByKey(CanAssignProductListToCompanyPermissionPlugin::KEY)
                        ->endUse()
                    ->endUse()
                ->endUse()
            ->endUse()
            ->useCompanyQuery()
                ->filterByUuid_In($companyUuids)
                ->filterByIsActive(true)
            ->endUse()
            ->select([SpyCompanyUserTableMap::COL_ID_COMPANY_USER])
            ->find()
            ->toArray();
    }

    /**
     * @param array<int> $companyUserIds
     *
     * @return array<string>
     */
    public function getWhitelistedCompanyUuidsByCompanyUserIds(array $companyUserIds): array
    {
        return $this->getFactory()
            ->getCompanyQuery()
            ->clear()
            ->useCompanyUserQuery()
                ->filterByIdCompanyUser_In($companyUserIds)
            ->endUse()
            ->filterByIsActive(true)
            ->filterByFkCompanyType(2, Criteria::NOT_EQUAL)
            ->select([SpyCompanyTableMap::COL_UUID])
            ->find()
            ->toArray();
    }
}
