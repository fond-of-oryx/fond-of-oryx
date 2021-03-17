<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Persistence;

use Generated\Shared\Transfer\ShipmentTableRateCriteriaFilterTransfer;
use Generated\Shared\Transfer\ShipmentTableRateTransfer;

interface ShipmentTableRateRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\ShipmentTableRateCriteriaFilterTransfer $shipmentTableRateCriteriaFilterTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentTableRateTransfer|null
     */
    public function getShipmentTableRate(
        ShipmentTableRateCriteriaFilterTransfer $shipmentTableRateCriteriaFilterTransfer
    ): ?ShipmentTableRateTransfer;
}
