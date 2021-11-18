<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpInvoiceItemTransfer;

interface ErpInvoiceItemPluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $erpInvoiceItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    public function executePostSavePlugins(ErpInvoiceItemTransfer $erpInvoiceItemTransfer): ErpInvoiceItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $erpInvoiceItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    public function executePreSavePlugins(ErpInvoiceItemTransfer $erpInvoiceItemTransfer): ErpInvoiceItemTransfer;
}
