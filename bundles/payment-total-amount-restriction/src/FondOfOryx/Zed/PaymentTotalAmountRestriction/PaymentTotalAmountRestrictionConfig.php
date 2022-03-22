<?php

namespace FondOfOryx\Zed\PaymentTotalAmountRestriction;

use FondOfOryx\Shared\PaymentTotalAmountRestriction\PaymentTotalAmountRestrictionConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class PaymentTotalAmountRestrictionConfig extends AbstractBundleConfig
{
    /**
     * @example ['payment-method-name' => 1000.00]
     *
     * @return array<string, float>
     */
    public function getTotalAmountRestrictedPaymentMethodCombinations(): array
    {
        return $this->get(PaymentTotalAmountRestrictionConstants::TOTAL_AMOUNT_RESTRICTED_PAYMENT_METHOD_COMBINATIONS, []);
    }
}
