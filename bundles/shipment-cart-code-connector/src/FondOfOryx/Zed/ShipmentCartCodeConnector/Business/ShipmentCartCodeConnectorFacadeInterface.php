<?php

namespace FondOfOryx\Zed\ShipmentCartCodeConnector\Business;

use Generated\Shared\Transfer\QuoteTransfer;

interface ShipmentCartCodeConnectorFacadeInterface
{
    /**
     * Specification:
     * - Sanitize shipment method from quote and items in case of cart code add, remove or clear action.
     * - Sanitize shipment expenses in case of cart code add, remove or clear.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function sanitizeShipment(QuoteTransfer $quoteTransfer): QuoteTransfer;
}
