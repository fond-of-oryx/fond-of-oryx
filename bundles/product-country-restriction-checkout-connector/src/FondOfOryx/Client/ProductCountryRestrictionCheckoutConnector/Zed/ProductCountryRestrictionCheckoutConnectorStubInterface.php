<?php

namespace FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\Zed;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;

interface ProductCountryRestrictionCheckoutConnectorStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteValidationResponseTransfer
     */
    public function validateQuote(QuoteTransfer $quoteTransfer): QuoteValidationResponseTransfer;
}
