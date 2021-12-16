<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestTotalsTransfer;

class RestTotalsMapper implements RestTotalsMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\RestTotalsTransfer|null
     */
    public function fromQuote(QuoteTransfer $quoteTransfer): ?RestTotalsTransfer
    {
        $totalTransfer = $quoteTransfer->getTotals();

        if ($totalTransfer === null) {
            return null;
        }

        $restTotalsTransfer = (new RestTotalsTransfer())->fromArray($totalTransfer->toArray(), true);

        if ($totalTransfer->getTaxTotal() !== null) {
            $restTotalsTransfer->setTaxTotal($totalTransfer->getTaxTotal()->getAmount());
        }

        return $restTotalsTransfer;
    }
}
