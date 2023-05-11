<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Dependency\Facade;

interface OrderBudgetSearchRestApiToOrderBudgetFacadeInterface
{
    /**
     * @param array<int> $orderBudgetIds
     *
     * @return array<\Generated\Shared\Transfer\OrderBudgetTransfer>
     */
    public function findOrderBudgetsByOrderBudgetIds(array $orderBudgetIds): array;
}
