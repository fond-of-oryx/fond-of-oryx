<?php

namespace FondOfOryx\Zed\PaymentAddressRestriction;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class PaymentAddressRestrictionConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const BLACKLISTED_PAYMENT_COUNTRY_COMBINATIONS = 'PaymentAddressRestrictionConfig:BLACKLISTED_PAYMENT_COUNTRY_COMBINATIONS';

    /**
     * @example ['payment-method-name' => ['DE', 'AT', 'CH']]
     *
     * @return array<string, array<int, string>>
     */
    public function getBlackListedPaymentCountryCombinations(): array
    {
        return $this->get(static::BLACKLISTED_PAYMENT_COUNTRY_COMBINATIONS, []);
    }
}
