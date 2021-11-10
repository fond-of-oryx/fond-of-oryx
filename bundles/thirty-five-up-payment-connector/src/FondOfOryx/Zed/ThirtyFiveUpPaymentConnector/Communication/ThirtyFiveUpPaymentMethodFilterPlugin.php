<?php

namespace FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\Communication;

use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PaymentExtension\Dependency\Plugin\PaymentMethodFilterPluginInterface;

/**
 * @method \FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\Business\ThirtyFiveUpPaymentConnectorFacade getFacade()
 */
class ThirtyFiveUpPaymentMethodFilterPlugin extends AbstractPlugin implements PaymentMethodFilterPluginInterface
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
        return $this->getFacade()->filterPaymentMethods($paymentMethodsTransfer, $quoteTransfer);
    }
}
