<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Business\Model;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentGroupTransfer;

interface PriceCalculatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ShipmentGroupTransfer|null $shipmentGroupTransfer
     *
     * @return int
     */
    public function calculate(QuoteTransfer $quoteTransfer, ?ShipmentGroupTransfer $shipmentGroupTransfer = null): int;
}
