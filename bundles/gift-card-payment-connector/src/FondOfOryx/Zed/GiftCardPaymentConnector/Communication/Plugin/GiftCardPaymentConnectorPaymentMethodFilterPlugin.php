<?php

namespace FondOfOryx\Zed\GiftCardPaymentConnector\Communication\Plugin;

use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PaymentExtension\Dependency\Plugin\PaymentMethodFilterPluginInterface;

/**
 * @method \FondOfOryx\Zed\GiftCardPaymentConnector\Business\GiftCardPaymentConnectorFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\GiftCardPaymentConnector\GiftCardPaymentConnectorConfig getConfig()
 */
class GiftCardPaymentConnectorPaymentMethodFilterPlugin extends AbstractPlugin implements PaymentMethodFilterPluginInterface
{
    /**
     * {@inheritDoc}
     *
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
