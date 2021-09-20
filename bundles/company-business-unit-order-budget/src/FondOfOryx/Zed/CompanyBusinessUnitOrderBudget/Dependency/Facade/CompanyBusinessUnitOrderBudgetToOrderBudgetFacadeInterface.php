<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade;

use Generated\Shared\Transfer\OrderBudgetTransfer;

interface CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface
{
    /**
     * @param int|null $budget
     *
     * @return \Generated\Shared\Transfer\OrderBudgetTransfer
     */
    public function createOrderBudget(?int $budget = null): OrderBudgetTransfer;

    /**
     * @param \Generated\Shared\Transfer\OrderBudgetTransfer $orderBudgetTransfer
     *
     * @return void
     */
    public function updateOrderBudget(OrderBudgetTransfer $orderBudgetTransfer): void;
}
