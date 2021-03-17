<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ShipmentTableRateTransfer;
use Orm\Zed\ShipmentTableRate\Persistence\FooShipmentTableRate;

interface ShipmentTableRateMapperInterface
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
    ): FooShipmentTableRate;

    /**
     * @param \Orm\Zed\ShipmentTableRate\Persistence\FooShipmentTableRate $fooShipmentTableRate
     * @param \Generated\Shared\Transfer\ShipmentTableRateTransfer $shipmentTableRateTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentTableRateTransfer
     */
    public function mapEntityToTransfer(
        FooShipmentTableRate $fooShipmentTableRate,
        ShipmentTableRateTransfer $shipmentTableRateTransfer
    ): ShipmentTableRateTransfer;
}
