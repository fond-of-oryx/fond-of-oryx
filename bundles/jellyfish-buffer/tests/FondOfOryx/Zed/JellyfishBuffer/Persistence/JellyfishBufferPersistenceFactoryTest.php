<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Persistence;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishBuffer\Persistence\Propel\Mapper\JellyfishBufferMapperInterface;
use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderQuery;

class JellyfishBufferPersistenceFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferPersistenceFactory
     */
    protected $jellyfishBufferPersistenceFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->jellyfishBufferPersistenceFactory = new JellyfishBufferPersistenceFactory();
    }

    /**
     * @return void
     */
    public function testCreateJellyfishBufferMapper(): void
    {
        $this->assertInstanceOf(
            JellyfishBufferMapperInterface::class,
            $this->jellyfishBufferPersistenceFactory->createJellyfishBufferMapper()
        );
    }

    /**
     * @return void
     */
    public function testCreateExportedOrderQuery(): void
    {
        $this->assertInstanceOf(
            FooExportedOrderQuery::class,
            $this->jellyfishBufferPersistenceFactory->createExportedOrderQuery()
        );
    }
}
