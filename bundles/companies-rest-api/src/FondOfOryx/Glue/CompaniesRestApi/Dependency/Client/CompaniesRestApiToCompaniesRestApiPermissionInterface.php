<?php

namespace FondOfOryx\Glue\CompaniesRestApi\Dependency\Client;

use Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer;

interface CompaniesRestApiToCompaniesRestApiPermissionInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
     *
     * @return bool
     */
    public function hasPermissionToDeleteCompany(
        CompaniesRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
    ): bool;
}