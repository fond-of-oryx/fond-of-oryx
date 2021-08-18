<?php

namespace FondOfOryx\Client\ErpOrderPermission;

use Exception;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\ErpOrderPermission\ErpOrderPermissionFactory getFactory()
 */
class ErpOrderPermissionClient extends AbstractClient implements ErpOrderPermissionClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer $erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer
     */
    public function getAccessibleCompanyBusinessUnitUuids(
        ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer $erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer
    ): CompanyBusinessUnitUuidCollectionTransfer {
        $transfer = $this->getFactory()
            ->createErpOrderPermissionStub()
            ->getAccessibleCompanyBusinessUnitUuids($erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer);

        if ($transfer instanceof CompanyBusinessUnitUuidCollectionTransfer) {
            return $transfer;
        }

        throw new Exception('Wrong response!');
    }
}
