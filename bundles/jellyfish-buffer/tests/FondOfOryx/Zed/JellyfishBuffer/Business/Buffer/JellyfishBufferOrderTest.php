<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Business\Buffer;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManagerInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;

class JellyfishBufferOrderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Business\Buffer\JellyfishBufferOrder
     */
    protected $jellyfishBufferOrder;

    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishBufferEntityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderMock;

    /**
     * @var array
     */
    protected $options;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->jellyfishBufferEntityManagerMock = $this->getMockBuilder(JellyfishBufferEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->options = [];

        $this->jellyfishBufferOrder = new JellyfishBufferOrder(
            $this->jellyfishBufferEntityManagerMock
        );
    }

    /**
     * @return void
     */
    public function testBufferOrder(): void
    {
        $this->jellyfishBufferOrder->bufferOrder(
            $this->jellyfishOrderMock,
            $this->options
        );
    }
}
