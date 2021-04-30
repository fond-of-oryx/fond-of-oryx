<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication;

use FondOfOryx\Zed\AvailabilityAlertCrossEngage\AvailabilityAlertCrossEngageDependencyProvider;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Service\AvailabilityAlertCrossEngageToCrossEngageServiceInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\AvailabilityAlertCrossEngage\AvailabilityAlertCrossEngageConfig getConfig()
 */
class AvailabilityAlertCrossEngageCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Service\AvailabilityAlertCrossEngageToCrossEngageServiceInterface
     */
    public function getCrossEngageService(): AvailabilityAlertCrossEngageToCrossEngageServiceInterface
    {
        return $this->getProvidedDependency(AvailabilityAlertCrossEngageDependencyProvider::SERVICE_CROSS_ENGAGE);
    }
}
