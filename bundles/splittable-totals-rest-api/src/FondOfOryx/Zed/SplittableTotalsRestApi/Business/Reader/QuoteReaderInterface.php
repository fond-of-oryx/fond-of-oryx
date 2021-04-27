<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApi\Business\Reader;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;

interface QuoteReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer|null
     */
    public function getByRestSplittableTotalsRequest(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
    ): ?QuoteTransfer;
}
