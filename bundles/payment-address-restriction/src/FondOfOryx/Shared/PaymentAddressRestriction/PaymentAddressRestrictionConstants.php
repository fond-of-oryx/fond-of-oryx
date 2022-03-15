<?php

namespace FondOfOryx\Shared\PaymentAddressRestriction;

interface PaymentAddressRestrictionConstants
{
    /**
     * @var string
     */
    public const BLACKLISTED_PAYMENT_COUNTRY_COMBINATIONS = 'PaymentAddressRestrictionConstants:BLACKLISTED_PAYMENT_COUNTRY_COMBINATIONS';

    /**
     * @var string
     */
    public const BLACKLISTED_PAYMENT_IDENTICAL_ADDRESS_REQUIRED = 'PaymentAddressRestrictionConstants:BLACKLISTED_PAYMENT_IDENTICAL_ADDRESS_REQUIRED';
}
