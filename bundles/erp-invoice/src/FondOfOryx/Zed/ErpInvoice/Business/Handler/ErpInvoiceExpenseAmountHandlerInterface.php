<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Handler;

use Generated\Shared\Transfer\ErpInvoiceExpenseTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

interface ErpInvoiceExpenseAmountHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    public function handle(
        ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer,
        ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null
    ): ErpInvoiceExpenseTransfer;
}
