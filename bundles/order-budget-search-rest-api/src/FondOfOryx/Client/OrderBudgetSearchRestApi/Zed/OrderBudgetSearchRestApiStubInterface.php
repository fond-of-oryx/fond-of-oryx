<?php

namespace FondOfOryx\Client\OrderBudgetSearchRestApi\Zed;

use Generated\Shared\Transfer\OrderBudgetListTransfer;

interface OrderBudgetSearchRestApiStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return \Generated\Shared\Transfer\OrderBudgetListTransfer
     */
    public function findOrderBudgets(OrderBudgetListTransfer $orderBudgetListTransfer): OrderBudgetListTransfer;
}
