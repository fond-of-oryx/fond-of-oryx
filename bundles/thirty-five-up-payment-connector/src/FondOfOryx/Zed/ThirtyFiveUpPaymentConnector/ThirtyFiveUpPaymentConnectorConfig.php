<?php

namespace FondOfOryx\Zed\ThirtyFiveUpPaymentConnector;

use FondOfOryx\Shared\ThirtyFiveUpPaymentConnector\ThirtyFiveUpPaymentConnectorConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ThirtyFiveUpPaymentConnectorConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getNotAllowedPaymentMethods(): array
    {
        return $this->get(ThirtyFiveUpPaymentConnectorConstants::NOT_ALLOWED_PAYMENT_METHODS, []);
    }
}
