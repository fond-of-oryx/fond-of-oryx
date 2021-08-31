<?php

namespace FondOfOryx\Zed\OrderBudget\Business;

interface OrderBudgetFacadeInterface
{
    /**
     * Specifications:
     * - Resets all order budgets
     *
     * @api
     *
     * @return void
     */
    public function resetOrderBudgets(): void;
}
