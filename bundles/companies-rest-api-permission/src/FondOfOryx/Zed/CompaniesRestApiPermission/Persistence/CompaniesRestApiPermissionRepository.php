<?php

namespace FondOfOryx\Zed\CompaniesRestApiPermission\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\CompaniesRestApiPermission\Persistence\CompaniesRestApiPermissionPersistenceFactory getFactory()
 */
class CompaniesRestApiPermissionRepository extends AbstractRepository implements CompaniesRestApiPermissionRepositoryInterface
{
    /**
     * @param string $permissionKey
     * @param string $customerReference
     * @param string $companyUuid
     *
     * @return bool
     */
    public function hasPermissionToDeleteCompany(
        string $permissionKey,
        string $customerReference,
        string $companyUuid
    ): bool {
        $spyCompanyRoleToPermissionQuery = $this->getFactory()->createSpyCompanyRoleToPermissionQuery();

        $result = $spyCompanyRoleToPermissionQuery->usePermissionQuery()
                ->filterByKey($permissionKey)
            ->endUse()
            ->useCompanyRoleQuery()
                ->useCompanyQuery()
                    ->filterByUuid($companyUuid)
                ->endUse()
                ->useSpyCompanyRoleToCompanyUserQuery()
                    ->useCompanyUserQuery()
                        ->useCustomerQuery()
                            ->filterByCustomerReference($customerReference)
                        ->endUse()
                    ->endUse()
                ->endUse()
            ->endUse()->findOne();

        return $result !== null;
    }
}
