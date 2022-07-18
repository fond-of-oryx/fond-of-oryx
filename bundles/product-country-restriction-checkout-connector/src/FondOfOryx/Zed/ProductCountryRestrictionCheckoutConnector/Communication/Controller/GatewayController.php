<?php

namespace FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Communication\Controller;

use Generated\Shared\Transfer\BlacklistedCountryTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\ProductCountryRestrictionCheckoutConnectorFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteValidationResponseTransfer
     */
    public function validateQuoteAction(
        QuoteTransfer $quoteTransfer
    ): QuoteValidationResponseTransfer {
        return $this->getFacade()->validateQuote($quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\BlacklistedCountryTransfer
     */
    public function getBlacklistedCountriesAction(QuoteTransfer $quoteTransfer): BlacklistedCountryTransfer
    {
        return $this->getFacade()->getBlacklistedCountries($quoteTransfer);
    }
}
