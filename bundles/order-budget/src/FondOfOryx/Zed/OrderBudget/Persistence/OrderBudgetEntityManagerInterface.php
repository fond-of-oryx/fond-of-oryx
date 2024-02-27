<?php

namespace FondOfOryx\Zed\OrderBudget\Persistence;

use DateTime;
use Generated\Shared\Transfer\OrderBudgetHistoryTransfer;
use Generated\Shared\Transfer\OrderBudgetTransfer;

interface OrderBudgetEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\OrderBudgetTransfer $orderBudgetTransfer
     *
     * @return \Generated\Shared\Transfer\OrderBudgetTransfer
     */
    public function createOrderBudget(
        OrderBudgetTransfer $orderBudgetTransfer
    ): OrderBudgetTransfer;

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

    /**
     * @param \DateTime $dateTime
     *
     * @return void
     */
    public function deleteOrderBudgetHistoryEntriesOlderThan(
        DateTime $dateTime
    ): void;
}
