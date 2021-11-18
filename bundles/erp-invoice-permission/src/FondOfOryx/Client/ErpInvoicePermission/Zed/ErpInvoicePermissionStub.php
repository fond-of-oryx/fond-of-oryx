<?php

namespace FondOfOryx\Client\ErpInvoicePermission\Zed;

use FondOfOryx\Client\ErpInvoicePermission\Dependency\Client\ErpInvoicePermissionToZedRequestInterface;
use Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer;

class ErpInvoicePermissionStub implements ErpInvoicePermissionStubInterface
{
    /**
     * @var \FondOfOryx\Client\ErpInvoicePermission\Dependency\Client\ErpInvoicePermissionToZedRequestInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\ErpInvoicePermission\Dependency\Client\ErpInvoicePermissionToZedRequestInterface $zedRequestClient
     */
    public function __construct(ErpInvoicePermissionToZedRequestInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function getAccessibleCompanyBusinessUnitUuids(
        ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer
    ) {
        return $this->zedRequestClient->call(
            '/erp-invoice-permission/gateway/get-accessible-company-business-unit-uuids',
            $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer,
        );
    }
}
