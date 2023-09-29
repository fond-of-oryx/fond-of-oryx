<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Reader;

use Generated\Shared\Transfer\ErpOrderExpenseCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderExpenseTransfer;

interface ErpOrderExpenseReaderInterface
{
    /**
     * @param int $idErpOrderExpense
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer|null
     */
    public function findErpOrderExpenseByIdErpOrderExpense(int $idErpOrderExpense): ?ErpOrderExpenseTransfer;

    /**
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseCollectionTransfer
     */
    public function findErpOrderExpensesByIdErpOrder(int $idErpOrder): ErpOrderExpenseCollectionTransfer;
}
