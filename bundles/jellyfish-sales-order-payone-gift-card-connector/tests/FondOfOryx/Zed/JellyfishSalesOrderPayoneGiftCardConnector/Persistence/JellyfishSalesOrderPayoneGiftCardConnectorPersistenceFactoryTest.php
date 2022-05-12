<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\Propel\Mapper\ProportionalGiftCardValueMapperInterface;
use Orm\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\FooProportionalGiftCardValueQuery;

class JellyfishSalesOrderPayoneGiftCardConnectorPersistenceFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorPersistenceFactory
     */
    protected $persistenceFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->persistenceFactory = new JellyfishSalesOrderPayoneGiftCardConnectorPersistenceFactory();
    }

    /**
     * @return void
     */
    public function testCreateProportionalGiftCardValueQuery(): void
    {
        static::assertInstanceOf(
            FooProportionalGiftCardValueQuery::class,
            $this->persistenceFactory->createProportionalGiftCardValueQuery(),
        );
    }

    /**
     * @return void
     */
    public function testCreateProportionalGiftCardValueMapper(): void
    {
        static::assertInstanceOf(
            ProportionalGiftCardValueMapperInterface::class,
            $this->persistenceFactory->createProportionalGiftCardValueMapper(),
        );
    }
}
