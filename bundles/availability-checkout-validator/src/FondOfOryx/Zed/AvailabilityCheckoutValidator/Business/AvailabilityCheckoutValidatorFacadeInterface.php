<?php

namespace FondOfOryx\Zed\AvailabilityCheckoutValidator\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;

interface AvailabilityCheckoutValidatorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteValidationResponseTransfer
     */
    public function validateQuote(QuoteTransfer $quoteTransfer): QuoteValidationResponseTransfer;
}
