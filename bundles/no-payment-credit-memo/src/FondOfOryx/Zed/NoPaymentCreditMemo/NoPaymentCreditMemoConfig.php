<?php

namespace FondOfOryx\Zed\NoPaymentCreditMemo;

use Spryker\Shared\Nopayment\NopaymentConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class NoPaymentCreditMemoConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getNoPaymentMethods(): array
    {
        return $this->get(NopaymentConstants::NO_PAYMENT_METHODS, []);
    }
}
