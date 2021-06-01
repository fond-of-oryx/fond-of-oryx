<?php

namespace FondOfOryx\Zed\SplittableTotalsShipmentConnector\Business;

use Generated\Shared\Transfer\QuoteTransfer;

interface SplittableTotalsShipmentConnectorFacadeInterface
{
    /**
     * Specifications:
     * - Expands splitted quote with shipment and expense
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $splittedQuoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expandSplittedQuote(
        QuoteTransfer $splittedQuoteTransfer
    ): QuoteTransfer;
}
