<?php

namespace FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client;

use FondOfOryx\Client\ErpInvoicePermission\ErpInvoicePermissionClientInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer;

class ErpInvoicePageSearchToErpInvoicePermissionClientBridge implements
    ErpInvoicePageSearchToErpInvoicePermissionClientInterface
{
    /**
     * @var \FondOfOryx\Client\ErpInvoicePermission\ErpInvoicePermissionClientInterface
     */
    protected $erpInvoicePermissionClient;

    /**
     * @param \FondOfOryx\Client\ErpInvoicePermission\ErpInvoicePermissionClientInterface $erpInvoicePermissionClient
     */
    public function __construct(
        ErpInvoicePermissionClientInterface $erpInvoicePermissionClient
    ) {
        $this->erpInvoicePermissionClient = $erpInvoicePermissionClient;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer
     */
    public function getAccessibleCompanyBusinessUnitUuids(
        ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer
    ): CompanyBusinessUnitUuidCollectionTransfer {
        return $this->erpInvoicePermissionClient->getAccessibleCompanyBusinessUnitUuids(
            $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer,
        );
    }
}
