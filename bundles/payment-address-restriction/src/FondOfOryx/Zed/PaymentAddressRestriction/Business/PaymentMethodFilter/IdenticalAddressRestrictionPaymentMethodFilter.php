<?php

namespace FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter;

use ArrayObject;
use FondOfOryx\Zed\PaymentAddressRestriction\PaymentAddressRestrictionConfig;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class IdenticalAddressRestrictionPaymentMethodFilter implements PaymentMethodFilterInterface
{
    /**
     * @var \FondOfOryx\Zed\PaymentAddressRestriction\PaymentAddressRestrictionConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\PaymentAddressRestriction\PaymentAddressRestrictionConfig $config
     */
    public function __construct(PaymentAddressRestrictionConfig $config)
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
        if ($this->hasRestrictedPaymentMethods($paymentMethodsTransfer) === false) {
            return $paymentMethodsTransfer;
        }

        return $this->removeNotAllowedPaymentMethods($paymentMethodsTransfer, $quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentMethodsTransfer $paymentMethodsTransfer
     *
     * @return bool
     */
    protected function hasRestrictedPaymentMethods(PaymentMethodsTransfer $paymentMethodsTransfer): bool
    {
        foreach ($paymentMethodsTransfer->getMethods() as $paymentMethodTransfer) {
            if (in_array($paymentMethodTransfer->getMethodName(), $this->config->getBlackListedPaymentIdenticalAddressRequired(), true)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentMethodsTransfer $paymentMethodsTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    protected function removeNotAllowedPaymentMethods(
        PaymentMethodsTransfer $paymentMethodsTransfer,
        QuoteTransfer $quoteTransfer
    ): PaymentMethodsTransfer {
        $filteredPaymentMethods = new ArrayObject();

        foreach ($paymentMethodsTransfer->getMethods() as $paymentMethodTransfer) {
            if (!in_array($paymentMethodTransfer->getMethodName(), $this->config->getBlackListedPaymentIdenticalAddressRequired(), true)) {
                $filteredPaymentMethods->append($paymentMethodTransfer);

                continue;
            }

            if ($quoteTransfer->getBillingSameAsShipping() === true) {
                $filteredPaymentMethods->append($paymentMethodTransfer);
            }
        }

        return $paymentMethodsTransfer->setMethods($filteredPaymentMethods);
    }
}
