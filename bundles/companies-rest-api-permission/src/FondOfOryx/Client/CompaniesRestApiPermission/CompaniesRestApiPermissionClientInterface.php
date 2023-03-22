<?php

namespace FondOfOryx\Client\CompaniesRestApiPermission;

use Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer;

interface CompaniesRestApiPermissionClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
     *
     * @return bool
     * @throws \Exception
     */
    public function hasPermissionToDeleteCompany(
        CompaniesRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
    ): bool;
}
