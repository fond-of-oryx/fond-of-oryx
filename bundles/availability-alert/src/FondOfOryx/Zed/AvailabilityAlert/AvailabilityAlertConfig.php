<?php

namespace FondOfOryx\Zed\AvailabilityAlert;

use FondOfOryx\Shared\AvailabilityAlert\AvailabilityAlertConstants;
use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class AvailabilityAlertConfig extends AbstractBundleConfig
{
    /**
     * @return int
     */
    public function getMinimalPercentageDifference(): int
    {
        return $this->get(
            AvailabilityAlertConstants::MINIMAL_PERCENTAGE_DIFFERENCE,
            AvailabilityAlertConstants::MINIMAL_PERCENTAGE_DIFFERENCE_VALUE
        );
    }

    /**
     * @return string
     */
    public function getBaseUrlSslYves(): string
    {
        return $this->get(
            ApplicationConstants::BASE_URL_SSL_YVES
        );
    }
}
