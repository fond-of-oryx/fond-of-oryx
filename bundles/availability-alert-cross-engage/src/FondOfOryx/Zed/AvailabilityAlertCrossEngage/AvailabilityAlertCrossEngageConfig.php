<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage;

use FondOfOryx\Shared\AvailabilityAlertCrossEngage\AvailabilityAlertCrossEngageConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class AvailabilityAlertCrossEngageConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getSalt(): string
    {
        return $this->get(AvailabilityAlertCrossEngageConstants::AVAILABILITY_ALERT_CROSS_ENGAGE_SALT, '');
    }

    /**
     * @return bool
     */
    public function getDefaultSubscriberActivationState(): bool
    {
        return $this->get(AvailabilityAlertCrossEngageConstants::DEFAULT_SUBSCRIBER_ACTIVATION_STATE, false);
    }
}
