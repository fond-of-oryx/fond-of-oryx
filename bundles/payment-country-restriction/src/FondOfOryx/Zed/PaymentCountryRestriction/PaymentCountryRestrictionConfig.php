<?php

namespace FondOfOryx\Zed\PaymentCountryRestriction;

use FondOfOryx\Shared\PaymentCountryRestriction\PaymentCountryRestrictionConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class PaymentCountryRestrictionConfig extends AbstractBundleConfig
{
    /**
     * @return array<string, string>
     */
    public function getPaymentMethodWithAllowedCountries(): array
    {
        return $this->get(PaymentCountryRestrictionConstants::PAYMENT_METHOD_WITH_ALLOWED_COUNTRIES, []);
    }
}
