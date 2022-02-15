<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePermission\Communication\Controller;

use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNotePermission\Persistence\ErpDeliveryNotePermissionRepositoryInterface getRepository()()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer $erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer
     */
    public function getAccessibleCompanyBusinessUnitUuidsAction(
        ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer $erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer
    ): CompanyBusinessUnitUuidCollectionTransfer {
        return $this->getRepository()
            ->getAccessibleCompanyBusinessUnitUuidsByPermissionKeyAndCustomerReference(
                $erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer->getPermissionKey(),
                $erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer->getCustomerReference(),
            );
    }
}
