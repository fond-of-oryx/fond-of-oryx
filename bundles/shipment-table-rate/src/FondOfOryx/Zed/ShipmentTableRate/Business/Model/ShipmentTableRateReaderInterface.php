<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Business\Model;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentTableRateTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;

interface ShipmentTableRateReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\ShipmentTransfer $shipmentTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentTableRateTransfer|null
     */
    public function getByShipmentAndQuote(
        ShipmentTransfer $shipmentTransfer,
        QuoteTransfer $quoteTransfer
    ): ?ShipmentTableRateTransfer;
}
