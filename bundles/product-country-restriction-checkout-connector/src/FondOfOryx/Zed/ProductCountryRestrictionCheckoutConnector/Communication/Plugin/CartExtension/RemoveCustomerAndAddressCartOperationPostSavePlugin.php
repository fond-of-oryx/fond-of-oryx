<?php

namespace FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Communication\Plugin\CartExtension;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\CartExtension\Dependency\Plugin\CartOperationPostSavePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\ProductCountryRestrictionCheckoutConnectorFacadeInterface getFacade()
 */
class RemoveCustomerAndAddressCartOperationPostSavePlugin extends AbstractPlugin implements CartOperationPostSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function postSave(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $quoteValidationResponseTransfer = $this->getFacade()->validateQuote($quoteTransfer);

        if ($quoteValidationResponseTransfer->getIsSuccessful() === false) {
            $quoteTransfer->setBillingAddress(null)
                ->setShippingAddress(null)
                ->setBillingSameAsShipping(null);
        }

        return $quoteTransfer;
    }
}
