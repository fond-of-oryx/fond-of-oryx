<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Communication\Controller;

use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\OrderBudgetSearchRestApi\Business\OrderBudgetSearchRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return \Generated\Shared\Transfer\OrderBudgetListTransfer
     */
    public function findOrderBudgetsAction(OrderBudgetListTransfer $orderBudgetListTransfer): OrderBudgetListTransfer
    {
        return $this->getFacade()->findOrderBudgets($orderBudgetListTransfer);
    }
}
