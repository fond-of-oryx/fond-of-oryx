<?php

namespace FondOfOryx\Zed\ErpInvoicePermission\Communication\Controller;

use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\ErpInvoicePermission\Persistence\ErpInvoicePermissionRepositoryInterface getRepository()()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer
     */
    public function getAccessibleCompanyBusinessUnitUuidsAction(
        ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer
    ): CompanyBusinessUnitUuidCollectionTransfer {
        return $this->getRepository()
            ->getAccessibleCompanyBusinessUnitUuidsByPermissionKeyAndCustomerReference(
                $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer->getPermissionKey(),
                $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer->getCustomerReference(),
            );
    }
}
