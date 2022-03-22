<?php

namespace FondOfOryx\Zed\PaymentTotalAmountRestriction\Business\PaymentMethodFilter;

use FondOfOryx\Zed\PaymentTotalAmountRestriction\PaymentTotalAmountRestrictionConfig;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class PaymentTotalAmountRestrictionPaymentMethodFilter implements PaymentTotalAmountRestrictionPaymentMethodFilterInterface
{
    /**
     * @var \FondOfOryx\Zed\PaymentTotalAmountRestriction\PaymentTotalAmountRestrictionConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\PaymentTotalAmountRestriction\PaymentTotalAmountRestrictionConfig $config
     */
    public function __construct(PaymentTotalAmountRestrictionConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentMethodsTransfer $paymentMethodsTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    public function filterPaymentMethods(
        PaymentMethodsTransfer $paymentMethodsTransfer,
        QuoteTransfer $quoteTransfer
    ): PaymentMethodsTransfer {
        return $paymentMethodsTransfer;
    }
}
