<?php

namespace FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpInvoiceAddressTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

interface ErpInvoiceAddressPostSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after erp invoice address object was saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer
     */
    public function postSave(
        ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer,
        ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null
    ): ErpInvoiceAddressTransfer;
}
