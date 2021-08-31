<?php

namespace FondOfOryx\Zed\OrderBudget\Persistence;

interface OrderBudgetRepositoryInterface
{
    /**
     * @return \Generated\Shared\Transfer\OrderBudgetTransfer[]
     */
    public function findAllOrderBudgets(): array;
}
