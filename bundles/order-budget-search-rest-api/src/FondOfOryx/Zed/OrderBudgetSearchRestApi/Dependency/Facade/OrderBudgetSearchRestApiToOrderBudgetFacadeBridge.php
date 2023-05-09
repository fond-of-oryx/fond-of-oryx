<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Dependency\Facade;

use FondOfOryx\Zed\OrderBudget\Business\OrderBudgetFacadeInterface;

class OrderBudgetSearchRestApiToOrderBudgetFacadeBridge implements OrderBudgetSearchRestApiToOrderBudgetFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\OrderBudget\Business\OrderBudgetFacadeInterface
     */
    protected OrderBudgetFacadeInterface $orderBudgetFacade;

    /**
     * @param \FondOfOryx\Zed\OrderBudget\Business\OrderBudgetFacadeInterface $orderBudgetFacade
     */
    public function __construct(
        OrderBudgetFacadeInterface $orderBudgetFacade
    ) {
        $this->orderBudgetFacade = $orderBudgetFacade;
    }

    /**
     * @param array<int> $orderBudgetIds
     *
     * @return array<\Generated\Shared\Transfer\OrderBudgetTransfer>
     */
    public function findOrderBudgetsByOrderBudgetIds(array $orderBudgetIds): array
    {
        return $this->orderBudgetFacade->findOrderBudgetsByOrderBudgetIds($orderBudgetIds);
    }
}
