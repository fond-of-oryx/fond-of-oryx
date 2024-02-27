<?php

namespace FondOfOryx\Shared\OrderBudget;

interface OrderBudgetConstants
{
    /**
     * @var string
     */
    public const INITIAL_BUDGET = 'FOND_OF_ORYX:ORDER_BUDGET:INITIAL_BUDGET';

    /**
     * @var int
     */
    public const INITIAL_BUDGET_DEFAULT = 100000;

    /**
     * @var string
     */
    public const RETENTION_TIME_IN_DAYS = 'FOND_OF_ORYX:ORDER_BUDGET:RETENTION_TIME_IN_DAYS';

    /**
     * @var int
     */
    public const RETENTION_TIME_IN_DAYS_DEFAULT = 365;
}
