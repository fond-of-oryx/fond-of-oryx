<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Persistence;

use FondOfOryx\Zed\ShipmentTableRate\Persistence\Propel\Mapper\ShipmentTableRateMapper;
use FondOfOryx\Zed\ShipmentTableRate\Persistence\Propel\Mapper\ShipmentTableRateMapperInterface;
use Orm\Zed\ShipmentTableRate\Persistence\FooShipmentTableRateQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\ShipmentTableRate\Persistence\ShipmentTableRateRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ShipmentTableRate\ShipmentTableRateConfig getConfig()()
 */
class ShipmentTableRatePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ShipmentTableRate\Persistence\FooShipmentTableRateQuery
     */
    public function createShipmentTableRateQuery(): FooShipmentTableRateQuery
    {
        return FooShipmentTableRateQuery::create();
    }

    /**
     * @return \FondOfOryx\Zed\ShipmentTableRate\Persistence\Propel\Mapper\ShipmentTableRateMapperInterface
     */
    public function createShipmentTableRateMapper(): ShipmentTableRateMapperInterface
    {
        return new ShipmentTableRateMapper();
    }
}
