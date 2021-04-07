<?php

namespace FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;

interface ProductCountryRestrictionCheckoutConnectorFacadeInterface
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
