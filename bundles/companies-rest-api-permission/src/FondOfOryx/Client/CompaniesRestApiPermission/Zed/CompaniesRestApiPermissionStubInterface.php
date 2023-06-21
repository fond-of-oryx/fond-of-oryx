<?php

namespace FondOfOryx\Client\CompaniesRestApiPermission\Zed;

use Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer;

interface CompaniesRestApiPermissionStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompaniesRestApiPermissionResponseTransfer|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function hasPermissionToDeleteCompany(
        CompaniesRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
    );
}
