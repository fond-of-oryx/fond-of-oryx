<?php

namespace FondOfOryx\Client\CompaniesRestApiPermission;

use Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer;
use Generated\Shared\Transfer\CompaniesRestApiPermissionResponseTransfer;

interface CompaniesRestApiPermissionClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\CompaniesRestApiPermissionResponseTransfer
     */
    public function hasPermissionToDeleteCompany(
        CompaniesRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
    ): CompaniesRestApiPermissionResponseTransfer;
}
