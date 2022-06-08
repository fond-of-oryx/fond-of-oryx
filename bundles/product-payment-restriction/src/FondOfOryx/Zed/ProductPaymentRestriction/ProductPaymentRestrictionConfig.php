<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction;

use FondOfOryx\Shared\ProductPaymentRestriction\ProductPaymentRestrictionConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ProductPaymentRestrictionConfig extends AbstractBundleConfig
{
    /**
     * @description product attribute where blacklisted payment-methods stored
     *
     * @return string
     */
    public function getProductAttributeBlacklistedPaymentMethods(): string
    {
        return $this->get(ProductPaymentRestrictionConstants::BLACKLISTED_PAYMENT_METHODS_PRODUCT_ATTRIBUTE, 'blacklisted_payment_methods');
    }
}
