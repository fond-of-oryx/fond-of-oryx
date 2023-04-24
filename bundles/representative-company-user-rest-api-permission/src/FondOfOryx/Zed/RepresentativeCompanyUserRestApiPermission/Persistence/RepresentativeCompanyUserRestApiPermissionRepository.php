<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApiPermission\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserRestApiPermission\Persistence\RepresentativeCompanyUserRestApiPermissionPersistenceFactory getFactory()
 */
class RepresentativeCompanyUserRestApiPermissionRepository extends AbstractRepository implements RepresentativeCompanyUserRestApiPermissionRepositoryInterface
{
    /**
     * @param string $permissionKey
     * @param string $customerReference
     *
     * @return bool
     */
    public function hasPermission(
        string $permissionKey,
        string $customerReference
    ): bool {
        $spyCompanyRoleToPermissionQuery = $this->getFactory()->getSpyCompanyRoleToPermissionQuery();

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
            ->endUse()->findOne();

        return $result !== null;
    }
}
