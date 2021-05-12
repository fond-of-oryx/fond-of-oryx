<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Handler;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderTotalReaderInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderTotalWriterInterface;
use Generated\Shared\Transfer\ErpOrderTotalTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

class ErpOrderTotalHandlerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderTotalWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTotalWriterMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderTotalReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTotalReaderMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderTotalTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTotalTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderTotalHandlerInterface
     */
    protected $handler;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->erpOrderTotalWriterMock = $this->getMockBuilder(ErpOrderTotalWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderTotalReaderMock = $this->getMockBuilder(ErpOrderTotalReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderTransferMock = $this->getMockBuilder(ErpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderTotalTransferMock = $this->getMockBuilder(ErpOrderTotalTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->handler = new ErpOrderTotalHandler(
            $this->erpOrderTotalWriterMock,
            $this->erpOrderTotalReaderMock
        );
    }

    /**
     * @return void
     */
    public function testHandleCreate(): void
    {
        $idErpOrder = 1;

        $this->erpOrderTransferMock->expects($this->atLeastOnce())
            ->method('getIdErpOrder')
            ->willReturn($idErpOrder);

        $this->erpOrderTotalReaderMock->expects($this->once())
            ->method('findErpOrderTotalByIdErpOrder')
            ->with($idErpOrder)
            ->willReturn(null);

        $this->erpOrderTransferMock->expects($this->atLeastOnce())
            ->method('getTotal')
            ->willReturn($this->erpOrderTotalTransferMock);

        $this->erpOrderTotalTransferMock->expects($this->atLeastOnce())
            ->method('setFkErpOrder')
            ->with($idErpOrder)
            ->willReturn($this->erpOrderTotalTransferMock);

        $this->erpOrderTotalWriterMock->expects($this->atLeastOnce())
            ->method('create')
            ->with($this->erpOrderTotalTransferMock)
            ->willReturn($this->erpOrderTotalTransferMock);

        $this->erpOrderTransferMock->expects($this->atLeastOnce())
            ->method('setTotal')
            ->with($this->erpOrderTotalTransferMock)
            ->willReturn($this->erpOrderTransferMock);

        $erpOrderTransfer = $this->handler->handle($this->erpOrderTransferMock);

        $this->assertInstanceOf(ErpOrderTransfer::class, $erpOrderTransfer);
    }

    /**
     * @return void
     */
    public function testHandleUpdate(): void
    {
        $idErpOrder = 1;
        $idErpOrderTotal = 1;

        $this->erpOrderTransferMock->expects($this->atLeastOnce())
            ->method('getIdErpOrder')
            ->willReturn($idErpOrder);

        $this->erpOrderTotalReaderMock->expects($this->once())
            ->method('findErpOrderTotalByIdErpOrder')
            ->with($idErpOrder)
            ->willReturn($this->erpOrderTotalTransferMock);

        $this->erpOrderTransferMock->expects($this->atLeastOnce())
            ->method('getTotal')
            ->willReturn($this->erpOrderTotalTransferMock);

        $this->erpOrderTotalTransferMock->expects($this->atLeastOnce())
            ->method('fromArray')
            ->willReturn($this->erpOrderTotalTransferMock);

        $this->erpOrderTotalTransferMock->expects($this->atLeastOnce())
            ->method('modifiedToArray')
            ->willReturn([]);

        $this->erpOrderTotalTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->erpOrderTotalTransferMock->expects($this->once())
            ->method('getIdErpOrderTotal')
            ->willReturn($idErpOrderTotal);

        $this->erpOrderTotalReaderMock->expects($this->once())
            ->method('findErpOrderTotalByIdErpOrderTotal')
            ->with($idErpOrderTotal)
            ->willReturn($this->erpOrderTotalTransferMock);

        $this->erpOrderTotalWriterMock->expects($this->atLeastOnce())
            ->method('update')
            ->with($this->erpOrderTotalTransferMock)
            ->willReturn($this->erpOrderTotalTransferMock);

        $this->erpOrderTransferMock->expects($this->atLeastOnce())
            ->method('setTotal')
            ->with($this->erpOrderTotalTransferMock)
            ->willReturn($this->erpOrderTransferMock);

        $erpOrderTransfer = $this->handler->handle($this->erpOrderTransferMock);

        $this->assertInstanceOf(ErpOrderTransfer::class, $erpOrderTransfer);
    }
}
