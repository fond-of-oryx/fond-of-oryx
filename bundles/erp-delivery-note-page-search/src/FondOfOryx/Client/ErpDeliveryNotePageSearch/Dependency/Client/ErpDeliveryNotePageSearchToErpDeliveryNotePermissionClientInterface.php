<?php

namespace FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client;

use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer;

interface ErpDeliveryNotePageSearchToErpDeliveryNotePermissionClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer $erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer
     */
    public function getAccessibleCompanyBusinessUnitUuids(
        ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer $erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer
    ): CompanyBusinessUnitUuidCollectionTransfer;
}
