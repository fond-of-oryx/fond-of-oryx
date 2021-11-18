<?php

namespace FondOfOryx\Client\ErpInvoicePermission;

use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer;

interface ErpInvoicePermissionClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer
     */
    public function getAccessibleCompanyBusinessUnitUuids(
        ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer
    ): CompanyBusinessUnitUuidCollectionTransfer;
}
