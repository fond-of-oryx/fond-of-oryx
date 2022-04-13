<?php

namespace FondOfOryx\Zed\PaymentProductRestriction\Business\PaymentMethodFilter;

use FondOfOryx\Shared\PaymentProductRestriction\PaymentProductRestrictionConstants;
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
    protected function hasRestrictedPaymentMethods(
        PaymentMethodsTransfer $paymentMethodsTransfer,
        QuoteTransfer $quoteTransfer
    ): bool {
        if (!$this->config->getProductAttributeBlacklistedPaymentMethods() || count($this->config->getMappingBlacklistedPaymentMethods()) === 0) {
            return false;
        }

        $productAttributeBlacklistedPaymentMethods = $this->config->getProductAttributeBlacklistedPaymentMethods();

        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            if (
                !array_key_exists(PaymentProductRestrictionConstants::UNLOCALIZED_PRODUCHT_ATTRIBUTES, $itemTransfer->getAbstractAttributes()) ||
                !array_key_exists($productAttributeBlacklistedPaymentMethods, $itemTransfer->getAbstractAttributes()[PaymentProductRestrictionConstants::UNLOCALIZED_PRODUCHT_ATTRIBUTES])
            ) {
                continue;
            }

            $blacklistedPaymentMethodsByProduct = $itemTransfer->getAbstractAttributes()[PaymentProductRestrictionConstants::UNLOCALIZED_PRODUCHT_ATTRIBUTES][$productAttributeBlacklistedPaymentMethods];

            foreach ($paymentMethodsTransfer->getMethods() as $paymentMethodTransfer) {
                if (in_array($paymentMethodTransfer->getMethodName(), $blacklistedPaymentMethodsByProduct, true)) {
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
        $productAttributeBlacklistedPaymentMethods = $this->config->getProductAttributeBlacklistedPaymentMethods();
        $filteredPaymentMethodsTransfer = new PaymentMethodsTransfer();

        foreach ($paymentMethodsTransfer->getMethods() as $paymentMethodTransfer) {
            foreach ($quoteTransfer->getItems() as $itemTransfer) {
                $blacklistedPaymentMethodsByProduct = $itemTransfer->getAbstractAttributes()[PaymentProductRestrictionConstants::UNLOCALIZED_PRODUCHT_ATTRIBUTES][$productAttributeBlacklistedPaymentMethods];

                if (
                    !array_key_exists(PaymentProductRestrictionConstants::UNLOCALIZED_PRODUCHT_ATTRIBUTES, $itemTransfer->getAbstractAttributes()) ||
                    !array_key_exists($productAttributeBlacklistedPaymentMethods, $itemTransfer->getAbstractAttributes()[PaymentProductRestrictionConstants::UNLOCALIZED_PRODUCHT_ATTRIBUTES])
                ) {
                    $filteredPaymentMethodsTransfer->addMethod($paymentMethodTransfer);

                    continue;
                }

                if (!in_array($paymentMethodTransfer->getMethodName(), $blacklistedPaymentMethodsByProduct, true)) {
                    $filteredPaymentMethodsTransfer->addMethod($paymentMethodTransfer);
                }
            }
        }

        return $filteredPaymentMethodsTransfer;
    }
}
