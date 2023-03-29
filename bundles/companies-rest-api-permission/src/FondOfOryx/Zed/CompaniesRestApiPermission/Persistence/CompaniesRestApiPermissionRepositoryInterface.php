<?php

namespace FondOfOryx\Zed\CompaniesRestApiPermission\Persistence;

interface CompaniesRestApiPermissionRepositoryInterface
{
    /**
     * @param string $permissionKey
     * @param string $customerReference
     * @param string $companyUuid
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return bool
     */
    public function hasPermissionToDeleteCompany(
        string $permissionKey,
        string $customerReference,
        string $companyUuid
    ): bool;
}
