<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client;

use FondOfOryx\Client\ErpOrderPermission\ErpOrderPermissionClientInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer;

class ErpOrderPageSearchToErpOrderPermissionClientBridge implements
    ErpOrderPageSearchToErpOrderPermissionClientInterface
{
    /**
     * @var \FondOfOryx\Client\ErpOrderPermission\ErpOrderPermissionClientInterface
     */
    protected $erpOrderPermissionClient;

    /**
     * @param \FondOfOryx\Client\ErpOrderPermission\ErpOrderPermissionClientInterface $erpOrderPermissionClient
     */
    public function __construct(
        ErpOrderPermissionClientInterface $erpOrderPermissionClient
    ) {
        $this->erpOrderPermissionClient = $erpOrderPermissionClient;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer $erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer
     */
    public function getAccessibleCompanyBusinessUnitUuids(
        ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer $erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer
    ): CompanyBusinessUnitUuidCollectionTransfer {
        return $this->erpOrderPermissionClient->getAccessibleCompanyBusinessUnitUuids(
            $erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer
        );
    }
}
