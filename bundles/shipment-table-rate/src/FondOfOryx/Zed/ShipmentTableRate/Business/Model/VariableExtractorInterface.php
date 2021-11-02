<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Business\Model;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\TotalsTransfer;

interface VariableExtractorInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array<float>
     */
    public function extractFromQuote(QuoteTransfer $quoteTransfer): array;

    /**
     * @param \Generated\Shared\Transfer\TotalsTransfer $totalsTransfer
     *
     * @return array<float>
     */
    public function extractFromTotals(TotalsTransfer $totalsTransfer): array;
}
