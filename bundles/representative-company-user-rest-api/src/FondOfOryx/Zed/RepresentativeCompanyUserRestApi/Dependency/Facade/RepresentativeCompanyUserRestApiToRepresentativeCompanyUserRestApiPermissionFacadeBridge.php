<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade;

use FondOfOryx\Zed\RepresentativeCompanyUserRestApiPermission\Business\RepresentativeCompanyUserRestApiPermissionFacadeInterface;

class RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionFacadeBridge implements RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionFacadeInterface
{
    protected RepresentativeCompanyUserRestApiPermissionFacadeInterface $facade;

    /**
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserRestApiPermission\Business\RepresentativeCompanyUserRestApiPermissionFacadeInterface $permissionFacade
     */
    public function __construct(RepresentativeCompanyUserRestApiPermissionFacadeInterface $permissionFacade)
    {
        $this->facade = $permissionFacade;
    }

    /**
     * @param string $permissionKey
     * @param string $customerReference
     *
     * @return bool
     */
    public function can(string $permissionKey, string $customerReference): bool
    {
        return $this->facade->can($permissionKey, $customerReference);
    }
}
