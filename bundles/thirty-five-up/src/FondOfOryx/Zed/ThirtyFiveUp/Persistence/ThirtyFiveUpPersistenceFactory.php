<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Persistence;

use FondOfOryx\Zed\ThirtyFiveUp\Persistence\Propel\Mapper\ThirtyFiveUpEntityMapper;
use FondOfOryx\Zed\ThirtyFiveUp\Persistence\Propel\Mapper\ThirtyFiveUpEntityMapperInterface;
use Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrderItemQuery;
use Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrderQuery;
use Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpVendorQuery;
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
     * @return \Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrderQuery
     */
    public function createThirtyFiveUpOrderQuery(): FooThirtyFiveUpOrderQuery
    {
        return FooThirtyFiveUpOrderQuery::create();
    }

    /**
     * @return \Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrderItemQuery
     */
    public function createThirtyFiveUpOrderItemQuery(): FooThirtyFiveUpOrderItemQuery
    {
        return FooThirtyFiveUpOrderItemQuery::create();
    }

    /**
     * @return \Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpVendorQuery
     */
    public function createThirtyFiveUpVendorQuery(): FooThirtyFiveUpVendorQuery
    {
        return FooThirtyFiveUpVendorQuery::create();
    }
}
