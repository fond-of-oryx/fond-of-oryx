<?php

namespace FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpInvoiceItemTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

interface ErpInvoiceItemPreSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered before erp invoice item object is saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $erpInvoiceItemTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    public function preSave(ErpInvoiceItemTransfer $erpInvoiceItemTransfer, ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null): ErpInvoiceItemTransfer;
}
