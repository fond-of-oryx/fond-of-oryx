<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ShipmentTableRateTransfer;
use Orm\Zed\ShipmentTableRate\Persistence\FooShipmentTableRate;

class ShipmentTableRateMapper implements ShipmentTableRateMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ShipmentTableRateTransfer $shipmentTableRateTransfer
     * @param \Orm\Zed\ShipmentTableRate\Persistence\FooShipmentTableRate $fooShipmentTableRate
     *
     * @return \Orm\Zed\ShipmentTableRate\Persistence\FooShipmentTableRate
     */
    public function mapTransferToEntity(
        ShipmentTableRateTransfer $shipmentTableRateTransfer,
        FooShipmentTableRate $fooShipmentTableRate
    ): FooShipmentTableRate {
        $fooShipmentTableRate->fromArray(
            $shipmentTableRateTransfer->modifiedToArray(false),
        );

        return $fooShipmentTableRate;
    }

    /**
     * @param \Orm\Zed\ShipmentTableRate\Persistence\FooShipmentTableRate $fooShipmentTableRate
     * @param \Generated\Shared\Transfer\ShipmentTableRateTransfer $shipmentTableRateTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentTableRateTransfer
     */
    public function mapEntityToTransfer(
        FooShipmentTableRate $fooShipmentTableRate,
        ShipmentTableRateTransfer $shipmentTableRateTransfer
    ): ShipmentTableRateTransfer {
        return $shipmentTableRateTransfer->fromArray(
            $fooShipmentTableRate->toArray(),
            true,
        );
    }
}
