<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Mapper;

use Generated\Shared\Transfer\OrderBudgetHistoryTransfer;
use Generated\Shared\Transfer\OrderBudgetTransfer;

interface OrderBudgetHistoryMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\OrderBudgetTransfer $orderBudgetTransfer
     *
     * @return \Generated\Shared\Transfer\OrderBudgetHistoryTransfer
     */
    public function fromOrderBudget(OrderBudgetTransfer $orderBudgetTransfer): OrderBudgetHistoryTransfer;
}
