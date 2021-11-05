<?php

namespace FondOfOryx\Zed\GiftCardPaymentConnector;

use FondOfOryx\Shared\GiftCardPaymentConnector\GiftCardPaymentConnectorConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class GiftCardPaymentConnectorConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getNotAllowedPaymentMethods(): array
    {
        return $this->get(GiftCardPaymentConnectorConstants::NOT_ALLOWED_PAYMENT_METHODS, []);
    }
}
