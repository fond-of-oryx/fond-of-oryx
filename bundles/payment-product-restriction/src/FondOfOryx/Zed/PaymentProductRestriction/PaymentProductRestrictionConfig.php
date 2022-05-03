<?php

namespace FondOfOryx\Zed\PaymentProductRestriction;

use FondOfOryx\Shared\PaymentProductRestriction\PaymentProductRestrictionConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class PaymentProductRestrictionConfig extends AbstractBundleConfig
{
    /**
     * @description product attribute where blacklisted payment-methods stored
     *
     * @return string
     */
    public function getProductAttributeBlacklistedPaymentMethods(): string
    {
        return $this->get(PaymentProductRestrictionConstants::BLACKLISTED_PAYMENT_METHODS_PRODUCT_ATTRIBUTE, 'blacklisted_payment_methods');
    }
}
