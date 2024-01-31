<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApiPermission\Business;

interface RepresentativeCompanyUserRestApiPermissionFacadeInterface
{
    /**
     * @param string $permissionKey
     * @param string $customerReference
     * @return bool
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function can(string $permissionKey, string $customerReference): bool;
}
