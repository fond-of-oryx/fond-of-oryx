<?php

namespace FondOfOryx\Client\CompaniesRestApiPermission;

use Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer;

interface CompaniesRestApiPermissionClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function hasPermissionToDeleteCompany(
        CompaniesRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
    ): bool;
}
