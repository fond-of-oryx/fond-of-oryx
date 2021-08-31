<?php

namespace FondOfOryx\Zed\OrderBudget\Dependency\Service;

use DateTime;

interface OrderBudgetToUtilDateTimeServiceInterface
{
    /**
     * @param \DateTime $dateTime
     *
     * @return string
     */
    public function formatDateTime(DateTime $dateTime): string;
}
