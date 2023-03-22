<?php

namespace FondOfOryx\Client\CompaniesRestApiPermission;

use Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer;
use Generated\Shared\Transfer\CompaniesRestApiPermissionResponseTransfer;

interface CompaniesRestApiPermissionClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompaniesRestApiPermissionResponseTransfer
     * @throws \Exception
     */
    public function hasPermissionToDeleteCompany(
        CompaniesRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
    ): CompaniesRestApiPermissionResponseTransfer;
}
