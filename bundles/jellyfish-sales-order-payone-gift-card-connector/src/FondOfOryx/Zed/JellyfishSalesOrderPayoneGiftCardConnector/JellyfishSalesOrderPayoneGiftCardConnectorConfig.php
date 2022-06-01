<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector;

use FondOfOryx\Shared\PayoneCreditMemo\PayoneCreditMemoConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class JellyfishSalesOrderPayoneGiftCardConnectorConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getPayonePaymentMethods(): array
    {
        return $this->get(PayoneCreditMemoConstants::LISTENING_PAYMENT_METHODS, []);
    }
}
