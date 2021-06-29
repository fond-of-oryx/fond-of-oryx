<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishBuffer\Business\Buffer\JellyfishBufferInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;

class JellyfishBufferFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Business\JellyfishBufferFacade
     */
    protected $jellyfishBufferFacade;

    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Business\JellyfishBufferBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishBufferBusinessFactoryMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Business\Buffer\JellyfishBufferInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishBufferOrderMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->jellyfishBufferBusinessFactoryMock = $this->getMockBuilder(JellyfishBufferBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->options = [];

        $this->jellyfishBufferOrderMock = $this->getMockBuilder(JellyfishBufferInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishBufferFacade = new JellyfishBufferFacade();
        $this->jellyfishBufferFacade->setFactory($this->jellyfishBufferBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testBufferOrder(): void
    {
        $this->jellyfishBufferBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createJellyfishBufferOrder')
            ->willReturn($this->jellyfishBufferOrderMock);

        $this->jellyfishBufferOrderMock->expects($this->atLeastOnce())
            ->method('buffer')
            ->with(
                $this->jellyfishOrderTransferMock,
                $this->options
            );

        $this->jellyfishBufferFacade->bufferOrder(
            $this->jellyfishOrderTransferMock,
            $this->options
        );
    }
}
