<?php

namespace FondOfOryx\Client\ErpDeliveryNotePermission\Zed;

use FondOfOryx\Client\ErpDeliveryNotePermission\Dependency\Client\ErpDeliveryNotePermissionToZedRequestInterface;
use Generated\Shared\Transfer\ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer;

class ErpDeliveryNotePermissionStub implements ErpDeliveryNotePermissionStubInterface
{
    /**
     * @var \FondOfOryx\Client\ErpDeliveryNotePermission\Dependency\Client\ErpDeliveryNotePermissionToZedRequestInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\ErpDeliveryNotePermission\Dependency\Client\ErpDeliveryNotePermissionToZedRequestInterface $zedRequestClient
     */
    public function __construct(ErpDeliveryNotePermissionToZedRequestInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer $erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function getAccessibleCompanyBusinessUnitUuids(
        ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer $erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer
    ) {
        return $this->zedRequestClient->call(
            '/erp-delivery-note-permission/gateway/get-accessible-company-business-unit-uuids',
            $erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer,
        );
    }
}
