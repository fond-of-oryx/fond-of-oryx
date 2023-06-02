<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApiPermission\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApiPermission\Persistence\RepresentativeCompanyUserTradeFairRestApiPermissionPersistenceFactory getFactory()
 */
class RepresentativeCompanyUserTradeFairRestApiPermissionRepository extends AbstractRepository implements RepresentativeCompanyUserTradeFairRestApiPermissionRepositoryInterface
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
