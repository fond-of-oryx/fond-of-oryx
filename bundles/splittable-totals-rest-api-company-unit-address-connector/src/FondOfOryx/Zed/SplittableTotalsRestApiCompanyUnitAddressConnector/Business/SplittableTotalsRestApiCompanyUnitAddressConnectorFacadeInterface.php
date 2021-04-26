<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;

interface SplittableTotalsRestApiCompanyUnitAddressConnectorFacadeInterface
{
    /**
     * Specifications:
     * - Expands quote with company unit addresses (billing / shipping)
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expandQuote(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer;
}
