<?php

namespace FondOfOryx\Zed\SplittableTotals\Business\Reader;

use Generated\Shared\Transfer\SplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\SplittableTotalsResponseTransfer;

interface SplittableTotalsReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableTotalsResponseTransfer
     */
    public function getBySplittableTotalsRequest(
        SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
    ): SplittableTotalsResponseTransfer;
}
