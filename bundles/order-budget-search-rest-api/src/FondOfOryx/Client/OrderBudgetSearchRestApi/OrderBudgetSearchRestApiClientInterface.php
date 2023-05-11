<?php

namespace FondOfOryx\Client\OrderBudgetSearchRestApi;

use Generated\Shared\Transfer\OrderBudgetListTransfer;

interface OrderBudgetSearchRestApiClientInterface
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
    public function findOrderBudgets(OrderBudgetListTransfer $orderBudgetListTransfer): OrderBudgetListTransfer;
}
