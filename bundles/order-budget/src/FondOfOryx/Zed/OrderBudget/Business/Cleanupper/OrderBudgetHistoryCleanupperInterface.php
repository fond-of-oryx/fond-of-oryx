<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Cleanupper;

interface OrderBudgetHistoryCleanupperInterface
{
    /**
     * @return void
     */
    public function removeOldHistoryEntries(): void;
}
