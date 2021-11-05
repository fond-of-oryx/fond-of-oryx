<?php

namespace FondOfOryx\Zed\GiftCardPaymentConnector\Business\PaymentMethodFilter;

use ArrayObject;
use FondOfOryx\Shared\GiftCardPaymentConnector\GiftCardPaymentConnectorConstants;
use FondOfOryx\Zed\GiftCardPaymentConnector\GiftCardPaymentConnectorConfig;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class GiftCardPaymentConnectorPaymentMethodFilter implements GiftCardPaymentConnectorPaymentMethodFilterInterface
{
    /**
     * @var \FondOfOryx\Zed\GiftCardPaymentConnector\GiftCardPaymentConnectorConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\GiftCardPaymentConnector\GiftCardPaymentConnectorConfig $config
     */
    public function __construct(GiftCardPaymentConnectorConfig $config)
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
        if ($this->paymentContainsGiftCard($quoteTransfer) === false) {
            return $paymentMethodsTransfer;
        }

        return $this->removeNotAllowedPaymentMethods($paymentMethodsTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    protected function paymentContainsGiftCard(QuoteTransfer $quoteTransfer): bool
    {
        foreach ($quoteTransfer->getPayments() as $paymentTransfer) {
            if ($paymentTransfer->getPaymentMethod() === GiftCardPaymentConnectorConstants::PAYMENT_PROVIDER_GIFT_CARD) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentMethodsTransfer $paymentMethodsTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    protected function removeNotAllowedPaymentMethods(
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
