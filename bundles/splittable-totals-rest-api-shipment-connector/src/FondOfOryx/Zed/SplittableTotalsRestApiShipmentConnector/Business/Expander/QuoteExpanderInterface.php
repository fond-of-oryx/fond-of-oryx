<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\Expander;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;

interface QuoteExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer;
}
