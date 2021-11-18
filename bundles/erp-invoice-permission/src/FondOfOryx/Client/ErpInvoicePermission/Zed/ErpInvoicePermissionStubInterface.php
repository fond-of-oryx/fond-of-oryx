<?php

namespace FondOfOryx\Client\ErpInvoicePermission\Zed;

use Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer;

interface ErpInvoicePermissionStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function getAccessibleCompanyBusinessUnitUuids(
        ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer
    );
}
