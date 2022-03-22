<?php

namespace FondOfOryx\Zed\PaymentTotalAmountRestriction\Business;

use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\PaymentTotalAmountRestriction\Business\PaymentTotalAmountRestrictionBusinessFactory getFactory()()
 */
class PaymentTotalAmountRestrictionFacade extends AbstractFacade implements PaymentTotalAmountRestrictionFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaymentMethodsTransfer $paymentMethodsTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    public function totalAmountRestrictionPaymentMethodFilter(
        PaymentMethodsTransfer $paymentMethodsTransfer,
        QuoteTransfer $quoteTransfer
    ): PaymentMethodsTransfer {
        return $this->getFactory()
            ->createPaymentTotalAmountRestrictionPaymentMethodFilter()
            ->filterPaymentMethods($paymentMethodsTransfer, $quoteTransfer);
    }
}
