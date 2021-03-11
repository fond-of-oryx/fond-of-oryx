<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Persistence;

use FondOfOryx\Zed\ThirtyFiveUp\Persistence\Propel\Mapper\ThirtyFiveUpEntityMapper;
use FondOfOryx\Zed\ThirtyFiveUp\Persistence\Propel\Mapper\ThirtyFiveUpEntityMapperInterface;
use Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderItemQuery;
use Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderQuery;
use Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpVendorQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\ThirtyFiveUp\ThirtyFiveUpConfig getConfig()
 * @method \FondOfOryx\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpRepositoryInterface getRepository()
 */
class ThirtyFiveUpPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \FondOfOryx\Zed\ThirtyFiveUp\Persistence\Propel\Mapper\ThirtyFiveUpEntityMapperInterface
     */
    public function createThirtyFiveUpEntityMapper(): ThirtyFiveUpEntityMapperInterface
    {
        return new ThirtyFiveUpEntityMapper();
    }

    /**
     * @return \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderQuery
     */
    public function createThirtyFiveUpOrderQuery(): ThirtyFiveUpOrderQuery
    {
        return ThirtyFiveUpOrderQuery::create();
    }

    /**
     * @return \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderItemQuery
     */
    public function createThirtyFiveUpOrderItemQuery(): ThirtyFiveUpOrderItemQuery
    {
        return ThirtyFiveUpOrderItemQuery::create();
    }

    /**
     * @return \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpVendorQuery
     */
    public function createThirtyFiveUpVendorQuery(): ThirtyFiveUpVendorQuery
    {
        return ThirtyFiveUpVendorQuery::create();
    }
}
