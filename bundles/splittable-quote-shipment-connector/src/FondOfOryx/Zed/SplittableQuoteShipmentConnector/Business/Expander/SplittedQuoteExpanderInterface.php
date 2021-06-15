<?php

namespace FondOfOryx\Zed\SplittableQuoteShipmentConnector\Business\Expander;

use Generated\Shared\Transfer\QuoteTransfer;

interface SplittedQuoteExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $splittedQuoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(QuoteTransfer $splittedQuoteTransfer): QuoteTransfer;
}
