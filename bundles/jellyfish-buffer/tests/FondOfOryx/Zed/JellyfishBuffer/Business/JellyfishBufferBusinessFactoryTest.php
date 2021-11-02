<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishBuffer\Business\Buffer\JellyfishBufferInterface;
use FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManager;

class JellyfishBufferBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Business\JellyfishBufferBusinessFactory
     */
    protected $jellyfishBufferBusinessFactory;

    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManager|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishBufferEntityManagerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->jellyfishBufferEntityManagerMock = $this->getMockBuilder(JellyfishBufferEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishBufferBusinessFactory = new JellyfishBufferBusinessFactory();
        $this->jellyfishBufferBusinessFactory->setEntityManager($this->jellyfishBufferEntityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreateJellyfishBufferOrder(): void
    {
        $this->assertInstanceOf(
            JellyfishBufferInterface::class,
            $this->jellyfishBufferBusinessFactory
                ->createJellyfishBufferOrder(),
        );
    }
}
