<?php

namespace FondOfOryx\Zed\DeliveryDateRestriction\Communication\Plugin\CheckoutExtension;

use Exception;
use Generated\Shared\Transfer\CheckoutErrorTransfer;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\CheckoutExtension\Dependency\Plugin\CheckoutPreConditionPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\DeliveryDateRestriction\Business\DeliveryDateRestrictionFacadeInterface getFacade()
 */
class DeliveryDateRestrictionCheckoutPreConditionPlugin extends AbstractPlugin implements CheckoutPreConditionPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\CheckoutResponseTransfer $checkoutResponseTransfer
     *
     * @return bool
     */
    public function checkCondition(QuoteTransfer $quoteTransfer, CheckoutResponseTransfer $checkoutResponseTransfer): bool
    {
        try {
            $this->getFacade()->validateQuote($quoteTransfer);

            return true;
        } catch (Exception $exception) {
            $checkoutErrorTransfer = (new CheckoutErrorTransfer())
                ->setMessage($exception->getMessage());

            $checkoutResponseTransfer
                ->setIsSuccess(false)
                ->addError($checkoutErrorTransfer);
        }

        return false;
    }
}
