<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Business;

use FondOfOryx\Zed\ProductPaymentRestriction\Business\PaymentMethodFilter\ProductPaymentRestrictionPaymentMethodFilter;
use FondOfOryx\Zed\ProductPaymentRestriction\Business\PaymentMethodFilter\ProductPaymentRestrictionPaymentMethodFilterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ProductPaymentRestriction\ProductPaymentRestrictionConfig getConfig()
 */
class ProductPaymentRestrictionBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ProductPaymentRestriction\Business\PaymentMethodFilter\ProductPaymentRestrictionPaymentMethodFilterInterface
     */
    public function createProductPaymentRestrictionPaymentMethodFilter(): ProductPaymentRestrictionPaymentMethodFilterInterface
    {
        return new ProductPaymentRestrictionPaymentMethodFilter($this->getConfig());
    }
}
