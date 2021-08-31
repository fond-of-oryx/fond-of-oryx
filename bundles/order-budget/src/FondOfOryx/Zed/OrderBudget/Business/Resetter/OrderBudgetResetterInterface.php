<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Resetter;

interface OrderBudgetResetterInterface
{
    /**
     * @return void
     */
    public function resetAll(): void;
}
