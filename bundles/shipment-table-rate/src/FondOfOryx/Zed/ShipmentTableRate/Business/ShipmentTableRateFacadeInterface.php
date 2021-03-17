<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentGroupTransfer;

interface ShipmentTableRateFacadeInterface
{
    /**
     * Specifications:
     * - Calculates price by shipment table rate
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ShipmentGroupTransfer|null $shipmentGroupTransfer
     *
     * @return int
     */
    public function calculatePrice(
        QuoteTransfer $quoteTransfer,
        ?ShipmentGroupTransfer $shipmentGroupTransfer = null
    ): int;
}
