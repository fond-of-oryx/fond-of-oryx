<?php

namespace FondOfOryx\Zed\OrderBudget;

use FondOfOryx\Shared\OrderBudget\OrderBudgetConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class OrderBudgetConfig extends AbstractBundleConfig
{
    /**
     * @return int
     */
    public function getInitialBudget(): int
    {
        return $this->get(OrderBudgetConstants::INITIAL_BUDGET, OrderBudgetConstants::INITIAL_BUDGET_DEFAULT);
    }
}
