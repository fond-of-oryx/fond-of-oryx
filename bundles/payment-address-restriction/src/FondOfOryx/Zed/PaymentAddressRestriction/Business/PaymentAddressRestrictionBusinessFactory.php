<?php

namespace FondOfOryx\Zed\PaymentAddressRestriction\Business;

use FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter\CountryRestrictionRestrictionPaymentMethodFilter;
use FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter\IdenticalAddressRestrictionPaymentMethodFilter;
use FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter\PaymentMethodFilterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\PaymentAddressRestriction\PaymentAddressRestrictionConfig getConfig()
 */
class PaymentAddressRestrictionBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter\PaymentMethodFilterInterface
     */
    public function createCountryRestrictionPaymentMethodFilter(): PaymentMethodFilterInterface
    {
        return new CountryRestrictionRestrictionPaymentMethodFilter($this->getConfig());
    }

    /**
     * @return \FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter\PaymentMethodFilterInterface
     */
    public function createIdenticalAddressRestrictionPaymentMethodFilter(): PaymentMethodFilterInterface
    {
        return new IdenticalAddressRestrictionPaymentMethodFilter($this->getConfig());
    }
}
