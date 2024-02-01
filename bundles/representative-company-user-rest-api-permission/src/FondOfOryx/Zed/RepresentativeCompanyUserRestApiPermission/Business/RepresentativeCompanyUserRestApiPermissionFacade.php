<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApiPermission\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserRestApiPermission\Persistence\RepresentativeCompanyUserRestApiPermissionRepositoryInterface getRepository()
 */
class RepresentativeCompanyUserRestApiPermissionFacade extends AbstractFacade implements RepresentativeCompanyUserRestApiPermissionFacadeInterface
{
    /**
     * @param string $permissionKey
     * @param string $customerReference
     *
     * @return bool
     */
    public function can(string $permissionKey, string $customerReference): bool
    {
        return $this->getRepository()->hasPermission($permissionKey, $customerReference);
    }
}
