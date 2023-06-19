<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Service;

use Spryker\Service\UtilDateTime\UtilDateTimeServiceInterface;

class RepresentativeCompanyUserToUtilDateTimeServiceBridge implements RepresentativeCompanyUserToUtilDateTimeServiceInterface
{
    /**
     * @var UtilDateTimeServiceInterface
     */
    protected $service;

    /**
     * @param UtilDateTimeServiceInterface $utilDateTimeService
     */
    public function __construct(UtilDateTimeServiceInterface $utilDateTimeService)
    {
        $this->service = $utilDateTimeService;
    }

    /**
     * Specification:
     * - Formats a given datetime string into a configured datetime
     *
     * @api
     *
     * @param \DateTime|string $date
     *
     * @return string
     */
    public function formatDateTime($date): string
    {
        return $this->service->formatDateTime($date);
    }
}
