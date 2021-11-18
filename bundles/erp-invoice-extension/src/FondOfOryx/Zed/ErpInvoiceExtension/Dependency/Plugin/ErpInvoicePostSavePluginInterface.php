<?php

namespace FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpInvoiceTransfer;

interface ErpInvoicePostSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after erp invoice object was saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    public function postSave(ErpInvoiceTransfer $erpInvoiceTransfer, ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null): ErpInvoiceTransfer;
}
