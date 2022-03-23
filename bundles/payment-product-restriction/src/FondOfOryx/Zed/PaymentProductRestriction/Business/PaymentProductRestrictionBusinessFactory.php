<?php

namespace FondOfOryx\Zed\PaymentProductRestriction\Business;

use FondOfOryx\Zed\PaymentProductRestriction\Business\PaymentMethodFilter\PaymentProductRestrictionPaymentMethodFilter;
use FondOfOryx\Zed\PaymentProductRestriction\Business\PaymentMethodFilter\PaymentProductRestrictionPaymentMethodFilterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\PaymentProductRestriction\PaymentProductRestrictionConfig getConfig()
 */
class PaymentProductRestrictionBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\PaymentProductRestriction\Business\PaymentMethodFilter\PaymentProductRestrictionPaymentMethodFilterInterface
     */
    public function createPaymentProductRestrictionPaymentMethodFilter(): PaymentProductRestrictionPaymentMethodFilterInterface
    {
        return new PaymentProductRestrictionPaymentMethodFilter($this->getConfig());
    }
}
