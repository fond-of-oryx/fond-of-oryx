<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication;

use FondOfOryx\Zed\AvailabilityAlertCrossEngage\AvailabilityAlertCrossEngageDependencyProvider;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Service\AvailabilityAlertCrossEngageToCrossEngageServiceInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class AvailabilityAlertCrossEngageCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Service\AvailabilityAlertCrossEngageToCrossEngageServiceInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getCrossEngageService(): AvailabilityAlertCrossEngageToCrossEngageServiceInterface
    {
        return $this->getProvidedDependency(AvailabilityAlertCrossEngageDependencyProvider::SERVICE_CROSS_ENGAGE);
    }
}
