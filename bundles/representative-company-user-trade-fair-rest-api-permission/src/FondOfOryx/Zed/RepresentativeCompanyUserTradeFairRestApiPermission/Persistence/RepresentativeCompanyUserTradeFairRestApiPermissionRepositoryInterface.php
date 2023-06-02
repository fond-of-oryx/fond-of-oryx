<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApiPermission\Persistence;

interface RepresentativeCompanyUserTradeFairRestApiPermissionRepositoryInterface
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
