<?php

namespace FondOfOryx\Zed\SplittableTotalsShipmentConnector\Dependency\Facade;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentMethodTransfer;

interface SplittableTotalsShipmentConnectorToShipmentFacadeInterface
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
