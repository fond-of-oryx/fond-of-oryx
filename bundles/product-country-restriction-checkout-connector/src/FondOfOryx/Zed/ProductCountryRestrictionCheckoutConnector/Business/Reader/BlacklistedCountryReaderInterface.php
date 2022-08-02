<?php

namespace FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Reader;

use Generated\Shared\Transfer\BlacklistedCountryCollectionTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface BlacklistedCountryReaderInterface
{
    /**
     * Specification
     * - Returns collection of blacklisted countries by quote
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\BlacklistedCountryCollectionTransfer
     */
    public function getByQuote(QuoteTransfer $quoteTransfer): BlacklistedCountryCollectionTransfer;

    /**
     * Specification
     * - Returns a multi-array, the array-key represents the product-sku, the value is a list of blacklisted countries by related items
     *
     * @example ['item-sku' => ['CH', 'AT', CZ]]
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array<string, array<string>>
     */
    public function getGroupedByQuote(QuoteTransfer $quoteTransfer): array;
}
