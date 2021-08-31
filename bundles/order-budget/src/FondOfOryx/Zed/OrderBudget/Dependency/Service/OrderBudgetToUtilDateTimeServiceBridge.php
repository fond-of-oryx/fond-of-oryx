<?php

namespace FondOfOryx\Zed\OrderBudget\Dependency\Service;

use DateTime;
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
     * @param \DateTime $dateTime
     *
     * @return string
     */
    public function formatDateTime(DateTime $dateTime): string
    {
        return $this->utilDateTimeService->formatDateTime($dateTime);
    }
}
