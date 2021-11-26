<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Writer;

use Generated\Shared\Transfer\ErpInvoiceExpenseTransfer;

interface ErpInvoiceExpenseWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    public function create(ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer): ErpInvoiceExpenseTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    public function update(ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer): ErpInvoiceExpenseTransfer;

    /**
     * @param int $idErpInvoiceExpense
     *
     * @return void
     */
    public function delete(int $idErpInvoiceExpense): void;
}
