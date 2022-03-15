<?php

namespace FondOfOryx\Zed\PaymentAddressRestriction\Business;

use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentAddressRestrictionBusinessFactory getFactory()
 */
class PaymentAddressRestrictionFacade extends AbstractFacade implements PaymentAddressRestrictionFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaymentMethodsTransfer $paymentMethodsTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    public function countryRestrictionPaymentMethodFilter(
        PaymentMethodsTransfer $paymentMethodsTransfer,
        QuoteTransfer $quoteTransfer
    ): PaymentMethodsTransfer {
        return $this->getFactory()
            ->createCountryRestrictionPaymentMethodFilter()
            ->filterPaymentMethods($paymentMethodsTransfer, $quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentMethodsTransfer $paymentMethodsTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    public function identicalAddressRestrictionPaymentMethodFilter(
        PaymentMethodsTransfer $paymentMethodsTransfer,
        QuoteTransfer $quoteTransfer
    ): PaymentMethodsTransfer {
        return $this->getFactory()
            ->createIdenticalAddressRestrictionPaymentMethodFilter()
            ->filterPaymentMethods($paymentMethodsTransfer, $quoteTransfer);
    }
}
