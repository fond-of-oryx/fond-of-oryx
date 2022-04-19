<?php

namespace FondOfOryx\Zed\PayoneCreditMemo;

use FondOfOryx\Shared\PayoneCreditMemo\PayoneCreditMemoConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class PayoneCreditMemoConfig extends AbstractBundleConfig
{
    /**
     * @return array<int, string>
     */
    public function getListeningPaymentMethods(): array
    {
        return $this->get(PayoneCreditMemoConstants::LISTENING_PAYMENT_METHODS, []);
    }
}
