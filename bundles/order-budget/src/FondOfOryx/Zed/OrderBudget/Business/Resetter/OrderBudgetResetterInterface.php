<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Resetter;

interface OrderBudgetResetterInterface
{
    /**
     * @param array<int> $orderBudgetIds
     *
     * @return void
     */
    public function resetMultiple(array $orderBudgetIds = []): void;
}
