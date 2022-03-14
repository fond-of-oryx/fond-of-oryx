<?php

namespace FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter;

use ArrayObject;
use FondOfOryx\Zed\PaymentAddressRestriction\PaymentAddressRestrictionConfig;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class CountryRestrictionRestrictionPaymentMethodFilter implements CountryRestrictionPaymentMethodFilterInterface
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
        if ($this->hasRestrictedPaymentMethods($paymentMethodsTransfer, $quoteTransfer) === false) {
            return $paymentMethodsTransfer;
        }

        return $this->removeNotAllowedPaymentMethods($paymentMethodsTransfer, $quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentMethodsTransfer $paymentMethodsTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    protected function hasRestrictedPaymentMethods(PaymentMethodsTransfer $paymentMethodsTransfer, QuoteTransfer $quoteTransfer): bool
    {
        foreach ($this->config->getBlackListedPaymentCountryCombinations() as $paymentMethodName => $iso2Countries) {
            foreach ($paymentMethodsTransfer->getMethods() as $paymentMethodTransfer) {
                if (
                    $paymentMethodTransfer->getMethodName() === $paymentMethodName
                    && !in_array($quoteTransfer->getBillingAddress()->getIso2Code(), $iso2Countries, true)
                ) {
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

        foreach ($this->config->getBlackListedPaymentCountryCombinations() as $paymentMethodName => $iso2Countries) {
            foreach ($paymentMethodsTransfer->getMethods() as $paymentMethodTransfer) {
                if (
                    $paymentMethodTransfer->getMethodName() !== $paymentMethodName
                    && in_array($quoteTransfer->getBillingAddress()->getIso2Code(), $iso2Countries, true)
                ) {
                    $filteredPaymentMethods->append($paymentMethodTransfer);
                }
            }
        }

        return $paymentMethodsTransfer->setMethods($filteredPaymentMethods);
    }
}
