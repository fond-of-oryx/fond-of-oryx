<?php

namespace FondOfOryx\Shared\Prepayment;

interface PrepaymentConstants
{
    public const PROVIDER_NAME = 'Prepayment';
    public const LAST_NAME_FOR_INVALID_TEST = 'Invalid';
    public const PAYMENT_METHOD_PREPAYMENT = 'prepayment';
    public const PREPAYMENT_PROPERTY_PATH = self::PAYMENT_METHOD_PREPAYMENT . self::PROVIDER_NAME;

    public const ACCOUNT_HOLDER = 'ACCOUNT_HOLDER';
    public const IBAN = 'IBAN';
    public const BIC = 'BIC';
    public const CUSTOM_TEXT = 'CUSTOM_TEXT';
}
