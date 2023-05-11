<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Business;

use Generated\Shared\Transfer\OrderBudgetListTransfer;

interface OrderBudgetSearchRestApiFacadeInterface
{
    /**
     * Specification:
     * - Finds order budgets by criteria from OrderBudgetListTransfer.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return \Generated\Shared\Transfer\OrderBudgetListTransfer
     */
    public function findOrderBudgets(
        OrderBudgetListTransfer $orderBudgetListTransfer
    ): OrderBudgetListTransfer;
}
