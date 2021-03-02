<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Service;

interface AvailabilityAlertCrossEngageToCrossEngageServiceInterface
{
    /**
     * @param string $string
     *
     * @return string
     */
    public function getHash(string $string): string;
}
