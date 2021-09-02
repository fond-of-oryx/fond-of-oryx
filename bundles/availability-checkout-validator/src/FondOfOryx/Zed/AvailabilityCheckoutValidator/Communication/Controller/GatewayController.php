<?php

namespace FondOfOryx\Zed\AvailabilityCheckoutValidator\Communication\Controller;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\AvailabilityCheckoutValidator\Business\AvailabilityCheckoutValidatorFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteValidationResponseTransfer
     */
    public function validateQuoteAction(QuoteTransfer $quoteTransfer): QuoteValidationResponseTransfer
    {
        return $this->getFacade()->validateQuote($quoteTransfer);
    }
}
