<?php

namespace FondOfOryx\Zed\SplittableQuoteShipmentConnector\Dependency\Facade;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentMethodTransfer;

interface SplittableQuoteShipmentConnectorToShipmentFacadeInterface
{
    /**
     * @param int $idShipmentMethod
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentMethodTransfer|null
     */
    public function findAvailableMethodById(
        int $idShipmentMethod,
        QuoteTransfer $quoteTransfer
    ): ?ShipmentMethodTransfer;
}
