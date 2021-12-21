<?php

namespace FondOfOryx\Zed\InvoiceExtension\Dependency\Plugin;

use Generated\Shared\Transfer\InvoiceTransfer;

interface InvoicePostSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after invoice object is saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function postSave(InvoiceTransfer $invoiceTransfer): InvoiceTransfer;
}
