<?php

namespace FondOfOryx\Client\SplittableTotalsRestApi;

use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;

interface SplittableTotalsRestApiClientInterface
{
    /**
     * Specifications:
     * - Splits quote by split item attribute
     * - Recalculates split quotes
     * - Retrieves totals per splitted quote
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer
     */
    public function getSplittableTotals(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
    ): RestSplittableTotalsResponseTransfer;
}
