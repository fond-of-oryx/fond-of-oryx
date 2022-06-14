<?php

namespace FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector;

use Spryker\Shared\Nopayment\NopaymentConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class GiftCardProportionalValueNoPaymentConnectorConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getNoPaymentMethods(): array
    {
        return $this->get(NopaymentConstants::NO_PAYMENT_METHODS, []);
    }
}
