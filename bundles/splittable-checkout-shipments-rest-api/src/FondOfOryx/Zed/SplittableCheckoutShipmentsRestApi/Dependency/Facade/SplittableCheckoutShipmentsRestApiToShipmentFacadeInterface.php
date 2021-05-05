<?php

namespace FondOfOryx\Zed\SplittableCheckoutShipmentsRestApi\Dependency\Facade;

use Generated\Shared\Transfer\QuoteTransfer;

interface SplittableCheckoutShipmentsRestApiToShipmentFacadeInterface
{
    /**
     * @param int $idShipmentMethod
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentMethodTransfer|null
     */
    public function findAvailableMethodById($idShipmentMethod, QuoteTransfer $quoteTransfer);

    /**
     * @param int $idShipmentMethod
     *
     * @return \Generated\Shared\Transfer\ShipmentMethodTransfer|null
     */
    public function findMethodById($idShipmentMethod);
}
