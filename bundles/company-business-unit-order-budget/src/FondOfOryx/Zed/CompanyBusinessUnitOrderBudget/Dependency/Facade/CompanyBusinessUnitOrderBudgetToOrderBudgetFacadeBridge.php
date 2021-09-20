<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade;

use FondOfOryx\Zed\OrderBudget\Business\OrderBudgetFacadeInterface;
use Generated\Shared\Transfer\OrderBudgetTransfer;

class CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeBridge implements
    CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface
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

    /**
     * @param \Generated\Shared\Transfer\OrderBudgetTransfer $orderBudgetTransfer
     *
     * @return void
     */
    public function updateOrderBudget(OrderBudgetTransfer $orderBudgetTransfer): void
    {
        $this->orderBudgetFacade->updateOrderBudget($orderBudgetTransfer);
    }
}
