<?php

namespace FondOfOryx\Zed\PaymentProductRestriction\Business\PaymentMethodFilter;

use FondOfOryx\Zed\PaymentProductRestriction\PaymentProductRestrictionConfig;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class PaymentProductRestrictionPaymentMethodFilter implements PaymentProductRestrictionPaymentMethodFilterInterface
{
    /**
     * @var \FondOfOryx\Zed\PaymentProductRestriction\PaymentProductRestrictionConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\PaymentProductRestriction\PaymentProductRestrictionConfig $config
     */
    public function __construct(PaymentProductRestrictionConfig $config)
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
