<?php

namespace FondOfOryx\Zed\PaymentProductRestriction\Communication;

use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PaymentExtension\Dependency\Plugin\PaymentMethodFilterPluginInterface;

/**
 * @method \FondOfOryx\Zed\PaymentProductRestriction\Business\PaymentProductRestrictionFacadeInterface getFacade()
 */
class PaymentProductRestrictionPaymentMethodFilterPlugin extends AbstractPlugin implements PaymentMethodFilterPluginInterface
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
        return $this->getFacade()->productRestrictionPaymentMethodFilter($paymentMethodsTransfer, $quoteTransfer);
    }
}
