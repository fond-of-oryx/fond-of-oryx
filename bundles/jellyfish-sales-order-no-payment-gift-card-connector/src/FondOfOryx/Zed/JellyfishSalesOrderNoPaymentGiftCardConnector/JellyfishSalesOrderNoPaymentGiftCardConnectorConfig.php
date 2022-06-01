<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector;

use Spryker\Shared\Nopayment\NopaymentConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class JellyfishSalesOrderNoPaymentGiftCardConnectorConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getNoPaymentMethods(): array
    {
        return $this->get(NopaymentConstants::NO_PAYMENT_METHODS, []);
    }
}
