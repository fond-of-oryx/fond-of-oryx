<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApiPermission\Persistence;

interface RepresentativeCompanyUserRestApiPermissionRepositoryInterface
{
    /**
     * @param string $permissionKey
     * @param string $customerReference
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return bool
     */
    public function hasPermission(
        string $permissionKey,
        string $customerReference
    ): bool;
}
