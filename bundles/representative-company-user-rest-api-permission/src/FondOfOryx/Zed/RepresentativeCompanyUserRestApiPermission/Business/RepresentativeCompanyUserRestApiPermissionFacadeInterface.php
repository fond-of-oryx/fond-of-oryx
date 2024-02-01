<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApiPermission\Business;

interface RepresentativeCompanyUserRestApiPermissionFacadeInterface
{
    /**
     * @param string $permissionKey
     * @param string $customerReference
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return bool
     */
    public function can(string $permissionKey, string $customerReference): bool;
}
