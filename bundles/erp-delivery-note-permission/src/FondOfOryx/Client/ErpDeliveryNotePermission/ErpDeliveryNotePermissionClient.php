<?php

namespace FondOfOryx\Client\ErpDeliveryNotePermission;

use Exception;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\ErpDeliveryNotePermission\ErpDeliveryNotePermissionFactory getFactory()
 */
class ErpDeliveryNotePermissionClient extends AbstractClient implements ErpDeliveryNotePermissionClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer $erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer
     */
    public function getAccessibleCompanyBusinessUnitUuids(
        ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer $erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer
    ): CompanyBusinessUnitUuidCollectionTransfer {
        $transfer = $this->getFactory()
            ->createErpDeliveryNotePermissionStub()
            ->getAccessibleCompanyBusinessUnitUuids($erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer);

        if ($transfer instanceof CompanyBusinessUnitUuidCollectionTransfer) {
            return $transfer;
        }

        throw new Exception('Wrong response!');
    }
}
