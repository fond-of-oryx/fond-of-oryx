<?php

namespace FondOfOryx\Zed\PaymentCountryRestriction\Business\PaymentMethodFilter;

use FondOfOryx\Zed\PaymentCountryRestriction\PaymentCountryRestrictionConfig;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class PaymentCountryRestrictionPaymentMethodFilter implements PaymentCountryRestrictionPaymentMethodFilterInterface
{
    /**
     * @var \FondOfOryx\Zed\PaymentCountryRestriction\PaymentCountryRestrictionConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\PaymentCountryRestriction\PaymentCountryRestrictionConfig $config
     */
    public function __construct(PaymentCountryRestrictionConfig $config)
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
