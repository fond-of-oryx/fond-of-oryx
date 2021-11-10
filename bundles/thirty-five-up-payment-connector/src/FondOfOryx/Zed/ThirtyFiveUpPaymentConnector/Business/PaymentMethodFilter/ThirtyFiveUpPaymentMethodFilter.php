<?php

namespace FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\Business\PaymentMethodFilter;

use ArrayObject;
use FondOfOryx\Shared\ThirtyFiveUpPaymentConnector\ThirtyFiveUpPaymentConnectorConstants;
use FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\ThirtyFiveUpPaymentConnectorConfig;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class ThirtyFiveUpPaymentMethodFilter implements ThirtyFiveUpPaymentMethodFilterInterface
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\ThirtyFiveUpPaymentConnectorConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\ThirtyFiveUpPaymentConnectorConfig $config
     */
    public function __construct(ThirtyFiveUpPaymentConnectorConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @var string
     */
    public const UNTRANSLATED_ATTRIBUTES_KEY = '_';

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
        if ($this->hasPaymentRestrictedItems($quoteTransfer) === false) {
            return $paymentMethodsTransfer;
        }

        return $this->removePrepaymentFromPaymentMethods($paymentMethodsTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    protected function hasPaymentRestrictedItems(QuoteTransfer $quoteTransfer): bool
    {
        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            $attributes = $itemTransfer->getAbstractAttributes();

            if (!isset($attributes[static::UNTRANSLATED_ATTRIBUTES_KEY])) {
                continue;
            }

            if (!isset($attributes[static::UNTRANSLATED_ATTRIBUTES_KEY][ThirtyFiveUpPaymentConnectorConstants::ITEM_ATTRIBUTE_CASEABLE_SKU])) {
                continue;
            }

            if (empty($attributes[static::UNTRANSLATED_ATTRIBUTES_KEY][ThirtyFiveUpPaymentConnectorConstants::ITEM_ATTRIBUTE_CASEABLE_SKU])) {
                continue;
            }

            return true;
        }

        return false;
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentMethodsTransfer $paymentMethodsTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    protected function removePrepaymentFromPaymentMethods(
        PaymentMethodsTransfer $paymentMethodsTransfer
    ): PaymentMethodsTransfer {
        $filteredPaymentMethods = new ArrayObject();

        foreach ($paymentMethodsTransfer->getMethods() as $paymentMethodTransfer) {
            if (in_array($paymentMethodTransfer->getMethodName(), $this->config->getNotAllowedPaymentMethods(), true)) {
                continue;
            }

            $filteredPaymentMethods->append($paymentMethodTransfer);
        }

        return $paymentMethodsTransfer->setMethods($filteredPaymentMethods);
    }
}
