<?php

namespace FondOfOryx\Zed\OrderBudget\Business;

use Generated\Shared\Transfer\OrderBudgetTransfer;

interface OrderBudgetFacadeInterface
{
    /**
     * Specification:
     * - Resets all order budgets
     * - Saves old data to history
     *
     * @api
     *
     * @return void
     */
    public function resetOrderBudgets(): void;

    /**
     * Specification:
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

    /**
     * Specification:
     * - Finds an order budget by OrderBudgetTransfer::idOrderBudget in the transfer
     * - Updates fields in an order budget entity
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderBudgetTransfer $orderBudgetTransfer
     *
     * @return void
     */
    public function updateOrderBudget(OrderBudgetTransfer $orderBudgetTransfer): void;

    /**
     * Specification:
     * - Finds an order budget transfer by id.
     * - Returns NULL if an order budget does not exist.
     *
     * @api
     *
     * @param int $idOrderBudget
     *
     * @return \Generated\Shared\Transfer\OrderBudgetTransfer|null
     */
    public function findOrderBudgetByIdOrderBudget(int $idOrderBudget): ?OrderBudgetTransfer;
}
