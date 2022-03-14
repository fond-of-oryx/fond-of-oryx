<?php

namespace FondOfOryx\Zed\PaymentAddressRestriction\Business;

use FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter\CountryRestrictionPaymentMethodFilterInterface;
use FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter\CountryRestrictionRestrictionPaymentMethodFilter;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\PaymentAddressRestriction\PaymentAddressRestrictionConfig getConfig()
 */
class PaymentAddressRestrictionBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter\CountryRestrictionPaymentMethodFilterInterface
     */
    public function createCountryRestrictionPaymentMethodFilter(): CountryRestrictionPaymentMethodFilterInterface
    {
        return new CountryRestrictionRestrictionPaymentMethodFilter($this->getConfig());
    }
}
