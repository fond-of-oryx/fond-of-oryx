<?php

namespace FondOfOryx\Zed\CompaniesRestApiPermission\Persistence;

use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\CompaniesRestApiPermission\Persistence\CompaniesRestApiPermissionPersistenceFactory getFactory()
 */
class CompaniesRestApiPermissionRepository extends AbstractRepository implements CompaniesRestApiPermissionRepositoryInterface
{
    /**
     * @param string $permissionKey
     * @param string $customerReference
     * @param int $idCompany
     *
     * @return bool
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function hasPermissionToDeleteCompany(
        string $permissionKey,
        string $customerReference,
        int $idCompany
    ): bool {
        $spyCompanyRoleToPermissionQuery = $this->getFactory()->createSpyCompanyRoleToPermissionQuery();

        $test = $spyCompanyRoleToPermissionQuery->usePermissionQuery()
                ->filterByKey($permissionKey)
            ->endUse()
            ->useCompanyRoleQuery()
                ->useSpyCompanyRoleToCompanyUserQuery()
                    ->useCompanyUserQuery()
                        ->useCustomerQuery()
                            ->filterByCustomerReference($customerReference)
                        ->endUse()
                        ->useCompanyBusinessUnitQuery()
                            ->withColumn(SpyCompanyBusinessUnitTableMap::COL_UUID, 'uuid')
                        ->endUse()
                    ->endUse()
                ->endUse()
            ->endUse()
            ->findByFkCompany($idCompany);

        return $test !== null;
    }
}
