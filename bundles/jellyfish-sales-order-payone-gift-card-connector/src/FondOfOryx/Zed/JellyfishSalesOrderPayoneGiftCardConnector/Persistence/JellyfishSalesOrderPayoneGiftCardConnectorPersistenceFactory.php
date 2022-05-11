<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence;

use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\Propel\Mapper\ProportionalGiftCardValueMapper;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\Propel\Mapper\ProportionalGiftCardValueMapperInterface;
use Orm\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\FooProportionalGiftCardValueQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorRepositoryInterface getRepository()
 */
class JellyfishSalesOrderPayoneGiftCardConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\FooProportionalGiftCardValueQuery
     */
    public function createProportionalGiftCardValueQuery(): FooProportionalGiftCardValueQuery
    {
        return FooProportionalGiftCardValueQuery::create();
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\Propel\Mapper\ProportionalGiftCardValueMapperInterface
     */
    public function createProportionalGiftCardValueMapper(): ProportionalGiftCardValueMapperInterface
    {
        return new ProportionalGiftCardValueMapper();
    }
}
