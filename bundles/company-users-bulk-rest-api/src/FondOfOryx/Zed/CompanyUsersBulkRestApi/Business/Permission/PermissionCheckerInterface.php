<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Permission;

use Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer;

interface PermissionCheckerInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
     * @return bool
     */
    public function checkPermission(
        RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
    ): bool;
}
