<?php

namespace FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\Business;

use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\Business\ThirtyFiveUpPaymentConnectorBusinessFactory getFactory()
 */
class ThirtyFiveUpPaymentConnectorFacade extends AbstractFacade implements ThirtyFiveUpPaymentConnectorFacadeInterface
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
            ->createThirtyFiveUpPaymentMethodFilter()
            ->filterPaymentMethods($paymentMethodsTransfer, $quoteTransfer);
    }
}
