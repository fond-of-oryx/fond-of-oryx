<?php

namespace FondOfOryx\Zed\OrderBudget\Business;

use Generated\Shared\Transfer\OrderBudgetTransfer;

interface OrderBudgetFacadeInterface
{
    /**
     * Specifications:
     * - Resets all order budgets
     * - Saves old data to history
     *
     * @api
     *
     * @return void
     */
    public function resetOrderBudgets(): void;

    /**
     * Specifications:
     * - Creates order budget
     * - If budget is null, initial budget from config will be used
     * - Retrieves saved database entity as a transfer object
     *
     * @api
     *
     * @param int|null $budget
     *
     * @return \Generated\Shared\Transfer\OrderBudgetTransfer
     */
    public function createOrderBudget(?int $budget = null): OrderBudgetTransfer;
}
