<?php

namespace FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Dependency\Facade;

use Generated\Shared\Transfer\OrderBudgetTransfer;

interface OrderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeInterface
{
    /**
     * @param int|null $budget
     *
     * @return \Generated\Shared\Transfer\OrderBudgetTransfer
     */
    public function createOrderBudget(?int $budget = null): OrderBudgetTransfer;
}
