<?php

namespace FondOfOryx\Zed\ShipmentTableRateExtension\Dependency\Plugin;

use Generated\Shared\Transfer\TotalsTransfer;

interface PriceToPayFilterPluginInterface
{
    /**
     * Specifications:
     * - Filters price to pay from totals transfer
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\TotalsTransfer $totalsTransfer
     *
     * @return int|null
     */
    public function filter(TotalsTransfer $totalsTransfer): ?int;
}
