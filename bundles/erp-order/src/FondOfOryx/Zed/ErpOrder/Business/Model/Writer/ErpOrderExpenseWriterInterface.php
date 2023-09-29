<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use Generated\Shared\Transfer\ErpOrderExpenseTransfer;

interface ErpOrderExpenseWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderExpenseTransfer $erpOrderExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer
     */
    public function create(ErpOrderExpenseTransfer $erpOrderExpenseTransfer): ErpOrderExpenseTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderExpenseTransfer $erpOrderExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer
     */
    public function update(ErpOrderExpenseTransfer $erpOrderExpenseTransfer): ErpOrderExpenseTransfer;

    /**
     * @param int $idErpOrderExpense
     *
     * @return void
     */
    public function delete(int $idErpOrderExpense): void;
}
