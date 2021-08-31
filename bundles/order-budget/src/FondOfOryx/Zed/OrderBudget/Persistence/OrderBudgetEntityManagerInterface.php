<?php

namespace FondOfOryx\Zed\OrderBudget\Persistence;

use Generated\Shared\Transfer\OrderBudgetHistoryTransfer;
use Generated\Shared\Transfer\OrderBudgetTransfer;

interface OrderBudgetEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\OrderBudgetTransfer $orderBudgetTransfer
     *
     * @return void
     */
    public function updateOrderBudget(OrderBudgetTransfer $orderBudgetTransfer): void;

    /**
     * @param \Generated\Shared\Transfer\OrderBudgetHistoryTransfer $orderBudgetHistoryTransfer
     *
     * @return \Generated\Shared\Transfer\OrderBudgetHistoryTransfer
     */
    public function createOrderBudgetHistory(
        OrderBudgetHistoryTransfer $orderBudgetHistoryTransfer
    ): OrderBudgetHistoryTransfer;
}
