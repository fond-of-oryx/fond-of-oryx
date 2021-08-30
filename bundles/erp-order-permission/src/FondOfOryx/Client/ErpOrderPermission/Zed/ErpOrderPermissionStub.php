<?php

namespace FondOfOryx\Client\ErpOrderPermission\Zed;

use FondOfOryx\Client\ErpOrderPermission\Dependency\Client\ErpOrderPermissionToZedRequestInterface;
use Generated\Shared\Transfer\ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer;

class ErpOrderPermissionStub implements ErpOrderPermissionStubInterface
{
    /**
     * @var \FondOfOryx\Client\ErpOrderPermission\Dependency\Client\ErpOrderPermissionToZedRequestInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\ErpOrderPermission\Dependency\Client\ErpOrderPermissionToZedRequestInterface $zedRequestClient
     */
    public function __construct(ErpOrderPermissionToZedRequestInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer $erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function getAccessibleCompanyBusinessUnitUuids(
        ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer $erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer
    ) {
        return $this->zedRequestClient->call(
            '/erp-order-permission/gateway/get-accessible-company-business-unit-uuids',
            $erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer
        );
    }
}
