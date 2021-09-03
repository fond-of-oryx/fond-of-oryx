<?php

namespace FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Dependency\Facade;

use FondOfOryx\Zed\OrderBudget\Business\OrderBudgetFacadeInterface;
use Generated\Shared\Transfer\OrderBudgetTransfer;

class OrderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeBridge implements
    OrderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\OrderBudget\Business\OrderBudgetFacadeInterface
     */
    protected $orderBudgetFacade;

    /**
     * @param \FondOfOryx\Zed\OrderBudget\Business\OrderBudgetFacadeInterface $orderBudgetFacade
     */
    public function __construct(OrderBudgetFacadeInterface $orderBudgetFacade)
    {
        $this->orderBudgetFacade = $orderBudgetFacade;
    }

    /**
     * @param int|null $budget
     *
     * @return \Generated\Shared\Transfer\OrderBudgetTransfer
     */
    public function createOrderBudget(?int $budget = null): OrderBudgetTransfer
    {
        return $this->orderBudgetFacade->createOrderBudget($budget);
    }
}
