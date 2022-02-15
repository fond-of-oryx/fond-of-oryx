<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer;

use Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer;

interface ErpDeliveryNoteExpenseWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer
     */
    public function create(ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer): ErpDeliveryNoteExpenseTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer
     */
    public function update(ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer): ErpDeliveryNoteExpenseTransfer;

    /**
     * @param int $idErpDeliveryNoteExpense
     *
     * @return void
     */
    public function delete(int $idErpDeliveryNoteExpense): void;
}
