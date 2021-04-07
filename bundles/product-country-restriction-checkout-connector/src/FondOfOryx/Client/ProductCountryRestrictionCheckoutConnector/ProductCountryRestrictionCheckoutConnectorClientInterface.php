<?php

namespace FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;

interface ProductCountryRestrictionCheckoutConnectorClientInterface
{
    /**
     * Specifications
     * - Validates quote by product country restrictions
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteValidationResponseTransfer
     */
    public function validateQuote(QuoteTransfer $quoteTransfer): QuoteValidationResponseTransfer;
}
