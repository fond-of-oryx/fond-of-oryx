<?php

namespace FondOfOryx\Client\ErpInvoicePermission;

use Exception;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\ErpInvoicePermission\ErpInvoicePermissionFactory getFactory()
 */
class ErpInvoicePermissionClient extends AbstractClient implements ErpInvoicePermissionClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer
     */
    public function getAccessibleCompanyBusinessUnitUuids(
        ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer
    ): CompanyBusinessUnitUuidCollectionTransfer {
        $transfer = $this->getFactory()
            ->createErpInvoicePermissionStub()
            ->getAccessibleCompanyBusinessUnitUuids($erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer);

        if ($transfer instanceof CompanyBusinessUnitUuidCollectionTransfer) {
            return $transfer;
        }

        throw new Exception('Wrong response!');
    }
}
