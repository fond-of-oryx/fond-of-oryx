<?php

namespace FondOfOryx\Zed\AvailabilityCheckoutValidator\Business\Validator;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;

interface ValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteValidationResponseTransfer
     */
    public function validate(QuoteTransfer $quoteTransfer): QuoteValidationResponseTransfer;
}
