<?php

namespace FondOfOryx\Zed\JellyfishAvailabilityAlert;

use FondOfOryx\Shared\JellyfishAvailabilityAlert\JellyfishAvailabilityAlertConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class JellyfishAvailabilityAlertConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->get(JellyfishAvailabilityAlertConstants::BASE_URI, 'http://rabbitmq.jellyfish.localhost');
    }

    /**
     * @return float
     */
    public function getTimeout(): float
    {
        return (float)$this->get(JellyfishAvailabilityAlertConstants::TIMEOUT, 4.0);
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->get(JellyfishAvailabilityAlertConstants::USERNAME, 'jellyfish');
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->get(JellyfishAvailabilityAlertConstants::PASSWORD, 'jellyfish');
    }

    /**
     * @return bool
     */
    public function dryRun(): bool
    {
        return $this->get(JellyfishAvailabilityAlertConstants::DRY_RUN, true);
    }
}
