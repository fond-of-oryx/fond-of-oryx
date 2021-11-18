<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpInvoiceAmountTransfer;

interface ErpInvoiceAmountPluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer
     */
    public function executePostSavePlugins(ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer): ErpInvoiceAmountTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer
     */
    public function executePreSavePlugins(ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer): ErpInvoiceAmountTransfer;
}
