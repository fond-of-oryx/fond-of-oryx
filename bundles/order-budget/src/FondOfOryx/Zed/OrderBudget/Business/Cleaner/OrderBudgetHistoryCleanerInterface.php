<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Cleaner;

interface OrderBudgetHistoryCleanerInterface
{
    /**
     * @return void
     */
    public function clean(): void;
}
