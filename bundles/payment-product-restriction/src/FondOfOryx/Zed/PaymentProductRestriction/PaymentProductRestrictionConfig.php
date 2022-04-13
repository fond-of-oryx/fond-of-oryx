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
        return $this->get(PaymentProductRestrictionConstants::BLACKLISTED_PAYMENT_METHODS_PRODUCT_ATTRIBUTE, '');
    }

    /**
     * @description array-key is the key that comes from the middleware, value the concrete payment method
     *
     * @example ['invoice' => 'payoneSecurityInvoice']
     *
     * @return array<string, string>
     */
    public function getMappingBlacklistedPaymentMethods(): array
    {
        return $this->get(PaymentProductRestrictionConstants::MAPPING_BLACKLISTED_PAYMENT_METHODS, []);
    }
}
