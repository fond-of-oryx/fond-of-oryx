<?php

namespace FondOfOryx\Client\AvailabilityCheckoutValidator\Zed;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;

interface AvailabilityCheckoutValidatorStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteValidationResponseTransfer
     */
    public function validateQuote(QuoteTransfer $quoteTransfer): QuoteValidationResponseTransfer;
}
