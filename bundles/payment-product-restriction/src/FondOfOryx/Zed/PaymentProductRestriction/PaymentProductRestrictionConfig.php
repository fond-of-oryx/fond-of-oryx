<?php

namespace FondOfOryx\Zed\PaymentProductRestriction;

use FondOfOryx\Shared\PaymentProductRestriction\PaymentProductRestrictionConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class PaymentProductRestrictionConfig extends AbstractBundleConfig
{
    /**
     * @example ['payment-method-name' => ['SKU-XXX-XX1', 'SKU-XXX-XX2']]
     *
     * @return array<string, array<int, string>>
     */
    public function getBlacklistedProductSkuPaymentMethodCombinations(): array
    {
        return $this->get(PaymentProductRestrictionConstants::BLACKLISTED_PRODUCT_SKU_PAYMENT_METHOD_COMBINATIONS, []);
    }
}
