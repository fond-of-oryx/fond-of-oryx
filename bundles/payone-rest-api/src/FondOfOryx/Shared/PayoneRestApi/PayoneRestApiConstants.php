<?php

namespace FondOfOryx\Shared\PayoneRestApi;

interface PayoneRestApiConstants
{
    // GENERAL
    /**
     * @var string
     */
    public const PROVIDER_NAME = 'payone';

    // credit/debit card methods
    /**
     * @var string
     */
    public const PAYMENT_METHOD_CREDITCARD = 'payment.payone.creditcard';

    // e-wallet methods
    /**
     * @var string
     */
    public const PAYMENT_METHOD_E_WALLET = 'payment.payone.e_wallet';

    // bank account based methods
    /**
     * @var string
     */
    public const PAYMENT_METHOD_DIRECT_DEBIT = 'payment.payone.direct_debit';

    /**
     * @var string
     */
    public const PAYMENT_METHOD_INVOICE = 'payment.payone.invoice';

    /**
     * @var string
     */
    public const PAYMENT_METHOD_SECURITY_INVOICE = 'payment.payone.security_invoice';

    /**
     * @var string
     */
    public const PAYMENT_METHOD_PREPAYMENT = 'payment.payone.prepayment';

    /**
     * @var string
     */
    public const PAYMENT_METHOD_CASH_ON_DELIVERY = 'payment.payone.cash_on_delivery';

    // online transfer methods
    /**
     * @var string
     */
    public const PAYMENT_METHOD_ONLINE_BANK_TRANSFER = 'payment.payone.online_bank_transfer';

    // klarna payments
    /**
     * @var string
     */
    public const PAYMENT_METHOD_KLARNA = 'payment.payone.klarna';

    // RESPONSE TYPE
    /**
     * @var string
     */
    public const RESPONSE_TYPE_APPROVED = 'APPROVED';

    // REQUEST TYPE
    /**
     * @var string
     */
    public const REQUEST_TYPE_AUTHORIZATION = 'authorization';
}
