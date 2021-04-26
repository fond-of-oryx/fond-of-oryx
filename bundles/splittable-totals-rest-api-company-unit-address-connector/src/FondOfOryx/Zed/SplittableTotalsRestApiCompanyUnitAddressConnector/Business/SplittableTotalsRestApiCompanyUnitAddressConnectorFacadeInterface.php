<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableTotalsRequestTransfer;

interface SplittableTotalsRestApiCompanyUnitAddressConnectorFacadeInterface
{
    /**
     * Specifications:
     * - Expands quote with company unit addresses (billing / shipping)
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expandQuote(
        SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer;
}
