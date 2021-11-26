<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpInvoiceExpenseTransfer;

interface ErpInvoiceExpensePluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    public function executePostSavePlugins(ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer): ErpInvoiceExpenseTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    public function executePreSavePlugins(ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer): ErpInvoiceExpenseTransfer;
}
