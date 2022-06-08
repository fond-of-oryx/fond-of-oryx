<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Business\PaymentMethodFilter;

use ArrayObject;
use FondOfOryx\Shared\ProductPaymentRestriction\ProductPaymentRestrictionConstants;
use FondOfOryx\Zed\ProductPaymentRestriction\ProductPaymentRestrictionConfig;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class ProductPaymentRestrictionPaymentMethodFilter implements ProductPaymentRestrictionPaymentMethodFilterInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductPaymentRestriction\ProductPaymentRestrictionConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\ProductPaymentRestriction\ProductPaymentRestrictionConfig $config
     */
    public function __construct(ProductPaymentRestrictionConfig $config)
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
        if ($this->config->getProductAttributeBlacklistedPaymentMethods() === '') {
            return false;
        }

        $productAttributeBlacklistedPaymentMethods = $this->config->getProductAttributeBlacklistedPaymentMethods();

        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            if ($this->hasProductRequiredAttributes($itemTransfer) === false) {
                continue;
            }

            $blacklistedPaymentMethodsByProduct = explode(',', $itemTransfer->getAbstractAttributes()[ProductPaymentRestrictionConstants::UNLOCALIZED_PRODUCT_ATTRIBUTES][$productAttributeBlacklistedPaymentMethods]);

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
        $filteredPaymentMethodsTransfer = new PaymentMethodsTransfer();
        $paymentMethods = [];
        $productAttributeBlacklistedPaymentMethods = $this->config->getProductAttributeBlacklistedPaymentMethods();

        foreach ($paymentMethodsTransfer->getMethods() as $paymentMethodTransfer) {
            $paymentMethods[$paymentMethodTransfer->getMethodName()] = $paymentMethodTransfer;
        }

        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            if ($this->hasProductRequiredAttributes($itemTransfer) === false) {
                continue;
            }

            $blacklistedPaymentMethodsByProduct = explode(',', $itemTransfer->getAbstractAttributes()[ProductPaymentRestrictionConstants::UNLOCALIZED_PRODUCT_ATTRIBUTES][$productAttributeBlacklistedPaymentMethods]);

            foreach ($blacklistedPaymentMethodsByProduct as $method) {
                if (!array_key_exists($method, $paymentMethods)) {
                    continue;
                }

                unset($paymentMethods[$method]);
            }
        }

        $filteredPaymentMethodsTransfer->setMethods(new ArrayObject($paymentMethods));

        return $filteredPaymentMethodsTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return bool
     */
    protected function hasProductRequiredAttributes(ItemTransfer $itemTransfer): bool
    {
        return isset(
            $itemTransfer->getAbstractAttributes()[ProductPaymentRestrictionConstants::UNLOCALIZED_PRODUCT_ATTRIBUTES][$this->config->getProductAttributeBlacklistedPaymentMethods()],
        );
    }
}
