<?php

namespace FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client;

use FondOfOryx\Client\ErpDeliveryNotePermission\ErpDeliveryNotePermissionClientInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer;

class ErpDeliveryNotePageSearchToErpDeliveryNotePermissionClientBridge implements
    ErpDeliveryNotePageSearchToErpDeliveryNotePermissionClientInterface
{
    /**
     * @var \FondOfOryx\Client\ErpDeliveryNotePermission\ErpDeliveryNotePermissionClientInterface
     */
    protected $erpDeliveryNotePermissionClient;

    /**
     * @param \FondOfOryx\Client\ErpDeliveryNotePermission\ErpDeliveryNotePermissionClientInterface $erpDeliveryNotePermissionClient
     */
    public function __construct(
        ErpDeliveryNotePermissionClientInterface $erpDeliveryNotePermissionClient
    ) {
        $this->erpDeliveryNotePermissionClient = $erpDeliveryNotePermissionClient;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer $erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer
     */
    public function getAccessibleCompanyBusinessUnitUuids(
        ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer $erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer
    ): CompanyBusinessUnitUuidCollectionTransfer {
        return $this->erpDeliveryNotePermissionClient->getAccessibleCompanyBusinessUnitUuids(
            $erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer,
        );
    }
}
