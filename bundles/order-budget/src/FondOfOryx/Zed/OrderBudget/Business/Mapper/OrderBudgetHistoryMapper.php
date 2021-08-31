<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Mapper;

use Generated\Shared\Transfer\OrderBudgetHistoryTransfer;
use Generated\Shared\Transfer\OrderBudgetTransfer;

class OrderBudgetHistoryMapper implements OrderBudgetHistoryMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\OrderBudgetTransfer $orderBudgetTransfer
     *
     * @return \Generated\Shared\Transfer\OrderBudgetHistoryTransfer
     */
    public function fromOrderBudget(OrderBudgetTransfer $orderBudgetTransfer): OrderBudgetHistoryTransfer
    {
        $orderBudgetHistoryTransfer = (new OrderBudgetHistoryTransfer())->fromArray(
            $orderBudgetTransfer->toArray(),
            true
        );

        return $orderBudgetHistoryTransfer
            ->setFkOrderBudget($orderBudgetTransfer->getIdOrderBudget())
            ->setFrom($orderBudgetTransfer->getUpdatedAt());
    }
}
