<?php

namespace FondOfOryx\Zed\SplittableTotals\Business;

use Generated\Shared\Transfer\SplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\SplittableTotalsResponseTransfer;

interface SplittableTotalsFacadeInterface
{
    /**
     * Specifications:
     * - Expand original quote by plugins
     * - Splits quote by configurable item attribute
     * - Recalculates splitted quotes
     * - Retrieves totals per splitted quote
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableTotalsResponseTransfer
     */
    public function getSplittableTotalsBySplittableTotalsRequest(
        SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
    ): SplittableTotalsResponseTransfer;
}
