<?php

namespace FondOfOryx\Zed\InvoiceExtension\Dependency\Plugin;

use Generated\Shared\Transfer\InvoiceTransfer;

interface InvoicePreSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered before credit memo object is saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\InvoiceTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function preSave(InvoiceTransfer $creditMemoTransfer): InvoiceTransfer;
}
