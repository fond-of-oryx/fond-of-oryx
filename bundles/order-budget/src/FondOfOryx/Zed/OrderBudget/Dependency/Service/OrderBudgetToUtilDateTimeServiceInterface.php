<?php

namespace FondOfOryx\Zed\OrderBudget\Dependency\Service;

interface OrderBudgetToUtilDateTimeServiceInterface
{
    /**
     * @param \DateTime|string $date
     *
     * @return string
     */
    public function formatDate($date): string;
}
