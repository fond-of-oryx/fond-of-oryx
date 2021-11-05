<?php

namespace FondOfOryx\Zed\GiftCardPaymentConnector\Business;

use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\GiftCardPaymentConnector\Business\GiftCardPaymentConnectorBusinessFactory getFactory()
 */
class GiftCardPaymentConnectorFacade extends AbstractFacade implements GiftCardPaymentConnectorFacadeInterface
{
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
        return $this->getFactory()
            ->createGiftCardPaymentConnectorPaymentMethod()
            ->filterPaymentMethods($paymentMethodsTransfer, $quoteTransfer);
    }
}
