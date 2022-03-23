<?php

namespace FondOfOryx\Zed\PaymentProductRestriction;

use FondOfOryx\Shared\PaymentTotalAmountRestriction\PaymentTotalAmountRestrictionConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class PaymentProductRestrictionConfig extends AbstractBundleConfig
{
    /**
     * @example ['payment-method-name' => 'SKU-XXX-XXX']
     *
     * @return array<string, string>
     */
    public function getBlacklistedProductSkuPaymentMethodCombinations(): array
    {
        return $this->get(PaymentTotalAmountRestrictionConstants::TOTAL_AMOUNT_RESTRICTED_PAYMENT_METHOD_COMBINATIONS, []);
    }
}
