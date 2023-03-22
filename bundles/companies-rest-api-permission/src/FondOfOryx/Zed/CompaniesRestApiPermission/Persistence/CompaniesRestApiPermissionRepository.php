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
     * @param int $idCompany
     *
     * @return bool
     */
    public function hasPermissionToDeleteCompany(
        string $permissionKey,
        string $customerReference,
        int $idCompany
    ): bool {
        $spyCompanyRoleToPermissionQuery = $this->getFactory()->createSpyCompanyRoleToPermissionQuery();

        $result = $spyCompanyRoleToPermissionQuery->usePermissionQuery()
                ->filterByKey($permissionKey)
            ->endUse()
            ->useCompanyRoleQuery()
                ->useSpyCompanyRoleToCompanyUserQuery()
                    ->useCompanyUserQuery()
                        ->useCustomerQuery()
                            ->filterByCustomerReference($customerReference)
                        ->endUse()
                    ->endUse()
                ->endUse()
            ->endUse()->filterByFkCompany($idCompany)
            ->findOne();

        return $result !== null;
    }
}
