<?php

namespace FondOfOryx\Zed\PaymentProductRestriction\Business\PaymentMethodFilter;

use ArrayObject;
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
        foreach ($this->config->getBlacklistedProductSkuPaymentMethodCombinations() as $paymentMethodName => $backlistedSkus) {
            foreach ($paymentMethodsTransfer->getMethods() as $paymentMethodTransfer) {
                if ($paymentMethodTransfer->getMethodName() !== $paymentMethodName) {
                    continue;
                }

                foreach ($quoteTransfer->getItems() as $itemTransfer) {
                    foreach ($backlistedSkus as $sku) {
                        if (strpos($itemTransfer->getSku(), $sku) !== false) {
                            return true;
                        }
                    }
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

        foreach ($paymentMethodsTransfer->getMethods() as $paymentMethodTransfer) {
            foreach ($this->config->getBlacklistedProductSkuPaymentMethodCombinations() as $paymentMethodName => $backlistedSkus) {
                if ($paymentMethodTransfer->getMethodName() !== $paymentMethodName) {
                    $filteredPaymentMethods->append($paymentMethodTransfer);

                    continue;
                }

                if ($this->hasRestrictedItems($quoteTransfer) === false) {
                    $filteredPaymentMethods->append($paymentMethodTransfer);
                }
            }
        }

        return $paymentMethodsTransfer->setMethods($filteredPaymentMethods);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    protected function hasRestrictedItems(QuoteTransfer $quoteTransfer): bool
    {
        foreach ($this->config->getBlacklistedProductSkuPaymentMethodCombinations() as $backlistedSkus) {
            foreach ($quoteTransfer->getItems() as $itemTransfer) {
                foreach ($backlistedSkus as $sku) {
                    if (strpos($itemTransfer->getSku(), $sku) !== false) {
                        return true;
                    }
                }
            }
        }

        return false;
    }
}
