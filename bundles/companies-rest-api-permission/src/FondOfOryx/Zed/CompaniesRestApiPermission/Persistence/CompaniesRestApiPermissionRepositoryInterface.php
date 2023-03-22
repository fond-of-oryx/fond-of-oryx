<?php

namespace FondOfOryx\Zed\CompaniesRestApiPermission\Persistence;

use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;

interface CompaniesRestApiPermissionRepositoryInterface
{
    /**
     * @param string $permissionKey
     * @param string $customerReference
     * @param int $idCompany
     *
     * @return bool
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function hasPermissionToDeleteCompany(
        string $permissionKey,
        string $customerReference,
        int $idCompany
    ): bool;
}
