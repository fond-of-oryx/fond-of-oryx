<?php

namespace FondOfOryx\Zed\Invoice\Business\Model;

use Generated\Shared\Transfer\InvoiceTransfer;

interface InvoicePluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function executePostSavePlugins(InvoiceTransfer $invoiceTransfer): InvoiceTransfer;

    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function executePreSavePlugins(InvoiceTransfer $invoiceTransfer): InvoiceTransfer;
}
