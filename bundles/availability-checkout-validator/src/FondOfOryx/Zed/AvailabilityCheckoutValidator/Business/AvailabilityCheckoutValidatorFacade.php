<?php

namespace FondOfOryx\Zed\AvailabilityCheckoutValidator\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\AvailabilityCheckoutValidator\Business\AvailabilityCheckoutValidatorBusinessFactory getFactory()
 */
class AvailabilityCheckoutValidatorFacade extends AbstractFacade implements AvailabilityCheckoutValidatorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteValidationResponseTransfer
     */
    public function validateQuote(QuoteTransfer $quoteTransfer): QuoteValidationResponseTransfer
    {
        return $this->getFactory()->createQuoteAvailabilityValidator()->validate($quoteTransfer);
    }
}
