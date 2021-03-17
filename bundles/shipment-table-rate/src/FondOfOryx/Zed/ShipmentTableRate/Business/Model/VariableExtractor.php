<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Business\Model;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\TotalsTransfer;

class VariableExtractor implements VariableExtractorInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return float[]
     */
    public function extractFromQuote(QuoteTransfer $quoteTransfer): array
    {
        $variables = [];

        $totalsTransfer = $quoteTransfer->getTotals();

        if ($totalsTransfer !== null) {
            $variables = array_merge($variables, $this->extractFromTotals($totalsTransfer));
        }

        return $variables;
    }

    /**
     * @param \Generated\Shared\Transfer\TotalsTransfer $totalsTransfer
     *
     * @return float[]
     */
    public function extractFromTotals(TotalsTransfer $totalsTransfer): array
    {
        $variables = [];

        if ($totalsTransfer->getPriceToPay() !== null) {
            $variables['priceToPay'] = (float)$totalsTransfer->getPriceToPay();
        }

        if ($totalsTransfer->getSubtotal() !== null) {
            $variables['subtotal'] = (float)$totalsTransfer->getSubtotal();
        }

        if ($totalsTransfer->getDiscountTotal() !== null) {
            $variables['discountTotal'] = (float)$totalsTransfer->getDiscountTotal();
        }

        return $variables;
    }
}
