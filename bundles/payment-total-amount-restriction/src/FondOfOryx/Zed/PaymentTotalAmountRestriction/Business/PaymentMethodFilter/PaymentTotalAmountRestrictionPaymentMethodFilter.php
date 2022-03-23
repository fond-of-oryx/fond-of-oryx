<?php

namespace FondOfOryx\Zed\PaymentTotalAmountRestriction\Business\PaymentMethodFilter;

use ArrayObject;
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
        foreach ($this->config->getTotalAmountRestrictedPaymentMethodCombinations() as $paymentMethodName => $maxTotalAmount) {
            foreach ($paymentMethodsTransfer->getMethods() as $paymentMethodTransfer) {
                if ($paymentMethodTransfer->getMethodName() === $paymentMethodName) {
                    return true;
                }
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

        foreach ($this->config->getTotalAmountRestrictedPaymentMethodCombinations() as $paymentMethodName => $maxTotalAmount) {
            foreach ($paymentMethodsTransfer->getMethods() as $paymentMethodTransfer) {
                if ($paymentMethodTransfer->getMethodName() !== $paymentMethodName) {
                    $filteredPaymentMethods->append($paymentMethodTransfer);

                    continue;
                }

                if ($quoteTransfer->getTotals()->getGrandTotal() <= $maxTotalAmount) {
                    $filteredPaymentMethods->append($paymentMethodTransfer);
                }
            }
        }

        return $paymentMethodsTransfer->setMethods($filteredPaymentMethods);
    }
}
