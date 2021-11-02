<?php

namespace FondOfOryx\Zed\Prepayment\Communication\Plugin\Checkout;

use FondOfOryx\Shared\Prepayment\PrepaymentConstants;
use Generated\Shared\Transfer\CheckoutErrorTransfer;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Payment\Dependency\Plugin\Checkout\CheckoutPostCheckPluginInterface;

/**
 * @method \FondOfOryx\Zed\Prepayment\Business\PrepaymentFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\Prepayment\Communication\PrepaymentCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\Prepayment\PrepaymentConfig getConfig()
 */
class PrepaymentPostCheckPlugin extends AbstractPlugin implements CheckoutPostCheckPluginInterface
{
    /**
     * @var int
     */
    public const ERROR_CODE_PAYMENT_FAILED = 500;

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\CheckoutResponseTransfer $checkoutResponseTransfer
     *
     * @return \Generated\Shared\Transfer\CheckoutResponseTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer, CheckoutResponseTransfer $checkoutResponseTransfer)
    {
        if (!$this->isAuthorizationApproved($quoteTransfer)) {
            $checkoutErrorTransfer = (new CheckoutErrorTransfer())
                ->setErrorCode(static::ERROR_CODE_PAYMENT_FAILED)
                ->setMessage('Something went wrong with your payment. Try again!');

            $checkoutResponseTransfer
                ->addError($checkoutErrorTransfer)
                ->setIsSuccess(false);
        }

        return $checkoutResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    protected function isAuthorizationApproved(QuoteTransfer $quoteTransfer)
    {
        $quoteTransfer->requireBillingAddress();

        $billingAddress = $quoteTransfer->getBillingAddress();
        $billingAddress->requireLastName();

        return ($billingAddress->getLastName() !== PrepaymentConstants::LAST_NAME_FOR_INVALID_TEST);
    }
}
