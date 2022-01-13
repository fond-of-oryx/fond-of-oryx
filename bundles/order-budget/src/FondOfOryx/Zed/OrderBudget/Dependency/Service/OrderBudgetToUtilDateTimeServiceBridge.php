<?php

namespace FondOfOryx\Zed\OrderBudget\Dependency\Service;

use Spryker\Service\UtilDateTime\UtilDateTimeServiceInterface;

class OrderBudgetToUtilDateTimeServiceBridge implements OrderBudgetToUtilDateTimeServiceInterface
{
    /**
     * @var \Spryker\Service\UtilDateTime\UtilDateTimeServiceInterface
     */
    protected $utilDateTimeService;

    /**
     * @param \Spryker\Service\UtilDateTime\UtilDateTimeServiceInterface $utilDateTimeService
     */
    public function __construct(UtilDateTimeServiceInterface $utilDateTimeService)
    {
        $this->utilDateTimeService = $utilDateTimeService;
    }

    /**
     * @param \DateTime|string $date
     *
     * @return string
     */
    public function formatDate($date): string
    {
        return $this->utilDateTimeService->formatDate($date);
    }
}
