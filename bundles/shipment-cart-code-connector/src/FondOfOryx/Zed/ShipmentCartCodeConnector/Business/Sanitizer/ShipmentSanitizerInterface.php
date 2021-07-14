<?php

namespace FondOfOryx\Zed\ShipmentCartCodeConnector\Business\Sanitizer;

use Generated\Shared\Transfer\QuoteTransfer;

interface ShipmentSanitizerInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function sanitize(QuoteTransfer $quoteTransfer): QuoteTransfer;
}
