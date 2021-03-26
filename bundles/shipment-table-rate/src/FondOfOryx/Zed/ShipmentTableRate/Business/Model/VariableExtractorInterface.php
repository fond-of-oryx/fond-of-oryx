<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Business\Model;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\TotalsTransfer;

interface VariableExtractorInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return float[]
     */
    public function extractFromQuote(QuoteTransfer $quoteTransfer): array;

    /**
     * @param \Generated\Shared\Transfer\TotalsTransfer $totalsTransfer
     *
     * @return float[]
     */
    public function extractFromTotals(TotalsTransfer $totalsTransfer): array;
}
