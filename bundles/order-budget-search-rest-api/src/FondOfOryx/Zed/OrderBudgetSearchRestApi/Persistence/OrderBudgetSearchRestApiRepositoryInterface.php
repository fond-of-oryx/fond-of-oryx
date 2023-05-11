<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence;

use Generated\Shared\Transfer\OrderBudgetListTransfer;

interface OrderBudgetSearchRestApiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return \Generated\Shared\Transfer\OrderBudgetListTransfer
     */
    public function findOrderBudgets(OrderBudgetListTransfer $orderBudgetListTransfer): OrderBudgetListTransfer;
}
