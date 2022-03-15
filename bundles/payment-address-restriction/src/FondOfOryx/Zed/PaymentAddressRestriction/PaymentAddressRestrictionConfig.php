<?php

namespace FondOfOryx\Zed\PaymentAddressRestriction;

use FondOfOryx\Shared\PaymentAddressRestriction\PaymentAddressRestrictionConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class PaymentAddressRestrictionConfig extends AbstractBundleConfig
{
    /**
     * @example ['payment-method-name' => ['DE', 'AT', 'CH']]
     *
     * @return array<string, array<int, string>>
     */
    public function getBlackListedPaymentCountryCombinations(): array
    {
        return $this->get(PaymentAddressRestrictionConstants::BLACKLISTED_PAYMENT_COUNTRY_COMBINATIONS, []);
    }

    /**
     * @example ['payment-method-name']
     *
     * @return array<int, string>
     */
    public function getBlackListedPaymentIdenticalAddressRequired(): array
    {
        return $this->get(PaymentAddressRestrictionConstants::BLACKLISTED_PAYMENT_IDENTICAL_ADDRESS_REQUIRED, []);
    }
}
