<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Service;

use FondOfOryx\Service\CrossEngage\CrossEngageServiceInterface;

class AvailabilityAlertCrossEngageToCrossEngageServiceBridge implements AvailabilityAlertCrossEngageToCrossEngageServiceInterface
{
    /**
     * @var \FondOfOryx\Service\CrossEngage\CrossEngageServiceInterface
     */
    protected $service;

    /**
     * @param \FondOfOryx\Service\CrossEngage\CrossEngageServiceInterface $crossEngageService
     */
    public function __construct(CrossEngageServiceInterface $crossEngageService)
    {
        $this->service = $crossEngageService;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function getHash(string $string): string
    {
        return $this->service->getHash($string);
    }
}
