<?php

namespace FondOfOryx\Zed\ShipmentTableRateExtension\Dependency\Plugin;

use Generated\Shared\Transfer\QuoteTransfer;

interface PriceToPayFilterPluginInterface
{
    /**
     * Specifications:
     * - Filters price to pay from quote transfer
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return int|null
     */
    public function filter(QuoteTransfer $quoteTransfer): ?int;
}
