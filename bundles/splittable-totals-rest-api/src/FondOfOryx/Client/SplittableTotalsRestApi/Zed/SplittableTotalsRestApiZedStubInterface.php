<?php

namespace FondOfOryx\Client\SplittableTotalsRestApi\Zed;

use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;

interface SplittableTotalsRestApiZedStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer
     */
    public function getSplittableTotals(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
    ): RestSplittableTotalsResponseTransfer;
}
