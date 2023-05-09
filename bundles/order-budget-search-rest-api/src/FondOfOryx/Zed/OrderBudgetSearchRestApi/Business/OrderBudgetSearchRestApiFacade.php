<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Business;

use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\OrderBudgetSearchRestApi\Business\OrderBudgetSearchRestApiBusinessFactory getFactory()
 */
class OrderBudgetSearchRestApiFacade extends AbstractFacade implements OrderBudgetSearchRestApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return \Generated\Shared\Transfer\OrderBudgetListTransfer
     */
    public function findOrderBudgets(OrderBudgetListTransfer $orderBudgetListTransfer): OrderBudgetListTransfer
    {
        return $this->getFactory()
            ->createOrderBudgetReader()
            ->findByOrderBudgetList($orderBudgetListTransfer);
    }
}
