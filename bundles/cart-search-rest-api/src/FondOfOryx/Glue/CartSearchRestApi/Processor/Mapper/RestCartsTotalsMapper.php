<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCartsTotalsTransfer;

class RestCartsTotalsMapper implements RestCartsTotalsMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\RestCartsTotalsTransfer|null
     */
    public function fromQuote(QuoteTransfer $quoteTransfer): ?RestCartsTotalsTransfer
    {
        $totalsTransfer = $quoteTransfer->getTotals();

        if ($totalsTransfer === null) {
            return null;
        }

        $restCartsTotalsTransfer = (new RestCartsTotalsTransfer())
            ->fromArray($totalsTransfer->toArray(), true);

        $taxTotalTransfer = $totalsTransfer->getTaxTotal();

        if ($taxTotalTransfer === null) {
            return $restCartsTotalsTransfer;
        }

        return $restCartsTotalsTransfer->setTaxTotal($taxTotalTransfer->getAmount());
    }
}
