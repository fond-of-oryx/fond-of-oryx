<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Persistence;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishBuffer\Persistence\Propel\Mapper\JellyfishBufferMapperInterface;

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
}
