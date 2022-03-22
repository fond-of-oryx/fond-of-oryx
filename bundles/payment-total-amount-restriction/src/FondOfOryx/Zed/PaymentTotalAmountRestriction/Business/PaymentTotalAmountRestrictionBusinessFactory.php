<?php

namespace FondOfOryx\Zed\PaymentTotalAmountRestriction\Business;

use FondOfOryx\Zed\PaymentTotalAmountRestriction\Business\PaymentMethodFilter\PaymentTotalAmountRestrictionPaymentMethodFilter;
use FondOfOryx\Zed\PaymentTotalAmountRestriction\Business\PaymentMethodFilter\PaymentTotalAmountRestrictionPaymentMethodFilterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\PaymentTotalAmountRestriction\PaymentTotalAmountRestrictionConfig getConfig()
 */
class PaymentTotalAmountRestrictionBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\PaymentTotalAmountRestriction\Business\PaymentMethodFilter\PaymentTotalAmountRestrictionPaymentMethodFilterInterface
     */
    public function createPaymentTotalAmountRestrictionPaymentMethodFilter(): PaymentTotalAmountRestrictionPaymentMethodFilterInterface
    {
        return new PaymentTotalAmountRestrictionPaymentMethodFilter($this->getConfig());
    }
}
