<?php

namespace FondOfOryx\Zed\DeliveryDateRestriction\Business;

use Generated\Shared\Transfer\QuoteTransfer;

interface DeliveryDateRestrictionFacadeInterface
{
    /**
     * Specification:
     * - Expands quote with validation message
     * - Skips if current user has permission to use multiple delivery dates
     * - Adds error message if quote has more than one delivery date or delivery date is not "earliest-date"
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expandQuote(QuoteTransfer $quoteTransfer): QuoteTransfer;

    /**
     * Specification:
     * - Checks if current user has permission to use multiple delivery dates
     * - Throws exception if quote is not valid
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    public function validateQuote(QuoteTransfer $quoteTransfer): void;
}
