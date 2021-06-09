<?php

namespace FondOfOryx\Zed\Prepayment\Communication\Plugin\Checkout;

use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Payment\Dependency\Plugin\Checkout\CheckoutPreCheckPluginInterface;

/**
 * @method \FondOfOryx\Zed\Prepayment\Communication\PrepaymentCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\Prepayment\Business\PrepaymentFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\Prepayment\PrepaymentConfig getConfig()
 */
class PrepaymentPreCheckPlugin extends AbstractPlugin implements CheckoutPreCheckPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\CheckoutResponseTransfer $checkoutResponseTransfer
     *
     * @return bool
     */
    public function execute(
        QuoteTransfer $quoteTransfer,
        CheckoutResponseTransfer $checkoutResponseTransfer
    ) {
        $checkoutResponseTransfer->setIsSuccess(true);

        return true;
    }
}
