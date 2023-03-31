<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Filter;

use Generated\Shared\Transfer\QuoteTransfer;

interface RestrictedItemsFilterInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function filter(QuoteTransfer $quoteTransfer): QuoteTransfer;
}
