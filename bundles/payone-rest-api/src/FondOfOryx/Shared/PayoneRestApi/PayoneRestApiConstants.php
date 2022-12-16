<?php

namespace FondOfOryx\Shared\PayoneRestApi;

interface PayoneRestApiConstants
{
    // GENERAL
    public const PROVIDER_NAME = 'payone';

    // credit/debit card methods
    public const PAYMENT_METHOD_CREDITCARD = 'payment.payone.creditcard';

    // e-wallet methods
    public const PAYMENT_METHOD_E_WALLET = 'payment.payone.e_wallet';

    // bank account based methods
    public const PAYMENT_METHOD_DIRECT_DEBIT = 'payment.payone.direct_debit';
    public const PAYMENT_METHOD_INVOICE = 'payment.payone.invoice';
    public const PAYMENT_METHOD_SECURITY_INVOICE = 'payment.payone.security_invoice';
    public const PAYMENT_METHOD_PREPAYMENT = 'payment.payone.prepayment';
    public const PAYMENT_METHOD_CASH_ON_DELIVERY = 'payment.payone.cash_on_delivery';

    // online transfer methods
    public const PAYMENT_METHOD_ONLINE_BANK_TRANSFER = 'payment.payone.online_bank_transfer';

    // klarna payments
    public const PAYMENT_METHOD_KLARNA = 'payment.payone.klarna';

    // RESPONSE TYPE
    public const RESPONSE_TYPE_APPROVED = 'APPROVED';

    // REQUEST TYPE
    public const REQUEST_TYPE_AUTHORIZATION = 'authorization';
}
