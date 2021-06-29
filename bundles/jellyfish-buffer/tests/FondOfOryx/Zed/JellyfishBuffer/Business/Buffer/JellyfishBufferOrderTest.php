<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Business\Buffer;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManagerInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

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
     * @var \Spryker\Shared\Kernel\Transfer\AbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $abstractTransferMock;

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

        $this->abstractTransferMock = $this->getMockBuilder(AbstractTransfer::class)
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
        $this->jellyfishBufferEntityManagerMock->expects(static::once())->method('createExportedOrder');

        $this->jellyfishBufferOrder->buffer(
            $this->jellyfishOrderMock,
            $this->options
        );
    }

    /**
     * @return void
     */
    public function testBufferOrderThrowsException(): void
    {
        $this->jellyfishBufferEntityManagerMock->expects(static::never())->method('createExportedOrder');

        $catch = null;

        try {
            $this->jellyfishBufferOrder->buffer(
                $this->abstractTransferMock,
                $this->options
            );
        } catch (Exception $exception) {
            $catch = $exception;
        }
        static::assertNotNull($catch);
    }
}
