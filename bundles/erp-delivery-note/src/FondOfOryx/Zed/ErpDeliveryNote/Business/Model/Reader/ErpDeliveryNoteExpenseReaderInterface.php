<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader;

use Generated\Shared\Transfer\ErpDeliveryNoteExpenseCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer;

interface ErpDeliveryNoteExpenseReaderInterface
{
    /**
     * @param int $idErpDeliveryNoteExpense
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer|null
     */
    public function findErpDeliveryNoteExpenseByIdErpDeliveryNoteExpense(int $idErpDeliveryNoteExpense): ?ErpDeliveryNoteExpenseTransfer;

    /**
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseCollectionTransfer
     */
    public function findErpDeliveryNoteExpensesByIdErpDeliveryNote(int $idErpDeliveryNote): ErpDeliveryNoteExpenseCollectionTransfer;
}
