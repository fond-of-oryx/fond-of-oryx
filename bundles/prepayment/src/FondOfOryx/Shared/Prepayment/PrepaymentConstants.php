<?php

namespace FondOfOryx\Shared\Prepayment;

interface PrepaymentConstants
{
    /**
     * @var string
     */
    public const PROVIDER_NAME = 'Prepayment';

    /**
     * @var string
     */
    public const LAST_NAME_FOR_INVALID_TEST = 'Invalid';

    /**
     * @var string
     */
    public const PAYMENT_METHOD_PREPAYMENT = 'prepayment';

    /**
     * @var string
     */
    public const PREPAYMENT_PROPERTY_PATH = self::PAYMENT_METHOD_PREPAYMENT . self::PROVIDER_NAME;

    /**
     * @var string
     */
    public const ACCOUNT_HOLDER = 'ACCOUNT_HOLDER';

    /**
     * @var string
     */
    public const IBAN = 'IBAN';

    /**
     * @var string
     */
    public const BIC = 'BIC';

    /**
     * @var string
     */
    public const CUSTOM_TEXT = 'CUSTOM_TEXT';
}
