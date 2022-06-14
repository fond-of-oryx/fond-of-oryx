<?php

namespace FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector;

use FondOfOryx\Shared\GiftCardProportionalValuePayoneConnector\GiftCardProportionalValuePayoneConnectorConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class GiftCardProportionalValuePayoneConnectorConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getPayonePaymentMethods(): array
    {
        return $this->get(GiftCardProportionalValuePayoneConnectorConstants::LISTENING_PAYMENT_METHODS, []);
    }

    /**
     * @return bool
     */
    public function getListeningToAllPayonePaymentMethods(): bool
    {
        return $this->get(GiftCardProportionalValuePayoneConnectorConstants::LISTENING_TO_ALL_PAYONE_METHODS, false);
    }
}
