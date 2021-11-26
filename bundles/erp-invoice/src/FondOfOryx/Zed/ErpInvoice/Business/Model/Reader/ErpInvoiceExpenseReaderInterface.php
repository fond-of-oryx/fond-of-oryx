<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Reader;

use Generated\Shared\Transfer\ErpInvoiceExpenseCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoiceExpenseTransfer;

interface ErpInvoiceExpenseReaderInterface
{
    /**
     * @param int $idErpInvoiceExpense
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer|null
     */
    public function findErpInvoiceExpenseByIdErpInvoiceExpense(int $idErpInvoiceExpense): ?ErpInvoiceExpenseTransfer;

    /**
     * @param int $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseCollectionTransfer
     */
    public function findErpInvoiceExpensesByIdErpInvoice(int $idErpInvoice): ErpInvoiceExpenseCollectionTransfer;
}
