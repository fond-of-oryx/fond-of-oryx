<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client;

use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer;

interface ErpOrderPageSearchToErpOrderPermissionClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer $erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer
     */
    public function getAccessibleCompanyBusinessUnitUuids(
        ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer $erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer
    ): CompanyBusinessUnitUuidCollectionTransfer;
}
