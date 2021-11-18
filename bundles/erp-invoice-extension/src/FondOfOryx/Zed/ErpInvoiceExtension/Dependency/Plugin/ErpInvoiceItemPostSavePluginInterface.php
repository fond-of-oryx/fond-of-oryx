<?php

namespace FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpInvoiceItemTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

interface ErpInvoiceItemPostSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after erp invoice item object was saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $erpInvoiceItemTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    public function postSave(ErpInvoiceItemTransfer $erpInvoiceItemTransfer, ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null): ErpInvoiceItemTransfer;
}
