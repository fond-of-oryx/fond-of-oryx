<?php

namespace FondOfOryx\Zed\ErpOrderPermission\Communication\Controller;

use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\ErpOrderPermission\Persistence\ErpOrderPermissionRepositoryInterface getRepository()()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer $erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer
     */
    public function getAccessibleCompanyBusinessUnitUuidsAction(
        ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer $erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer
    ): CompanyBusinessUnitUuidCollectionTransfer {
        return $this->getRepository()
            ->getAccessibleCompanyBusinessUnitUuidsByPermissionKeyAndCustomerReference(
                $erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer->getPermissionKey(),
                $erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer->getCustomerReference(),
            );
    }
}
