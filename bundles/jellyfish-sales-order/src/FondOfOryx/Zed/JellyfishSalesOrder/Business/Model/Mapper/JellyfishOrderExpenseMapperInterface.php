<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper;

use Generated\Shared\Transfer\JellyfishOrderExpenseTransfer;
use Orm\Zed\Sales\Persistence\SpySalesExpense;

interface JellyfishOrderExpenseMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesExpense $salesExpense
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderExpenseTransfer
     */
    public function fromSalesExpense(SpySalesExpense $salesExpense): JellyfishOrderExpenseTransfer;
}
