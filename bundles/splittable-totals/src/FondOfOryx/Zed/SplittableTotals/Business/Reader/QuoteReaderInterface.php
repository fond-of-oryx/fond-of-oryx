<?php

namespace FondOfOryx\Zed\SplittableTotals\Business\Reader;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableTotalsRequestTransfer;

interface QuoteReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer|null
     */
    public function getBySplittableTotalsRequest(
        SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
    ): ?QuoteTransfer;
}
