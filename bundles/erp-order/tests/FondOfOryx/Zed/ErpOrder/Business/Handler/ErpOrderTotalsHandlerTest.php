<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Handler;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderTotalsReaderInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderTotalsWriterInterface;
use Generated\Shared\Transfer\ErpOrderTotalsTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

class ErpOrderTotalsHandlerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderTotalsWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTotalsWriterMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderTotalsReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTotalsReaderMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderTotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTotalsTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderTotalsTransfer&\PHPUnit\Framework\MockObject\MockObject|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $existingErpOrderTotalsTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderTotalsHandlerInterface
     */
    protected $handler;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->erpOrderTotalsWriterMock = $this->getMockBuilder(ErpOrderTotalsWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderTotalsReaderMock = $this->getMockBuilder(ErpOrderTotalsReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderTransferMock = $this->getMockBuilder(ErpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderTotalsTransferMock = $this->getMockBuilder(ErpOrderTotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->existingErpOrderTotalsTransferMock = $this->getMockBuilder(ErpOrderTotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->handler = new ErpOrderTotalsHandler(
            $this->erpOrderTotalsReaderMock,
            $this->erpOrderTotalsWriterMock,
        );
    }

    /**
     * @return void
     */
    public function testHandleCreate(): void
    {
        $idErpOrderTotals = 1;

        $this->erpOrderTransferMock->expects(static::atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->erpOrderTotalsTransferMock);

        $this->erpOrderTotalsTransferMock->expects(static::atLeastOnce())
            ->method('getIdErpOrderTotals')
            ->willReturnOnConsecutiveCalls(null, $idErpOrderTotals);

        $this->erpOrderTotalsWriterMock->expects(static::atLeastOnce())
            ->method('create')
            ->with($this->erpOrderTotalsTransferMock)
            ->willReturn($this->erpOrderTotalsTransferMock);

        $this->erpOrderTransferMock->expects(static::atLeastOnce())
            ->method('setTotals')
            ->with($this->erpOrderTotalsTransferMock)
            ->willReturn($this->erpOrderTransferMock);

        $this->erpOrderTransferMock->expects(static::atLeastOnce())
            ->method('setFkTotals')
            ->with($idErpOrderTotals)
            ->willReturn($this->erpOrderTransferMock);

        $this->erpOrderTotalsTransferMock->expects(static::never())
            ->method('requireIdErpOrderTotals');

        $this->erpOrderTotalsReaderMock->expects(static::never())
            ->method('findErpOrderTotalsByIdErpOrderTotals');

        $this->erpOrderTotalsTransferMock->expects(static::never())
            ->method('toArray');

        $this->erpOrderTotalsWriterMock->expects(static::never())
            ->method('update');

        static::assertEquals(
            $this->erpOrderTransferMock,
            $this->handler->handle($this->erpOrderTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testHandleUpdate(): void
    {
        $idErpOrderTotals = 1;
        $data = [];

        $this->erpOrderTransferMock->expects(static::atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->erpOrderTotalsTransferMock);

        $this->erpOrderTotalsTransferMock->expects(static::atLeastOnce())
            ->method('getIdErpOrderTotals')
            ->willReturn($idErpOrderTotals);

        $this->erpOrderTotalsWriterMock->expects(static::never())
            ->method('create');

        $this->erpOrderTotalsTransferMock->expects(static::atLeastOnce())
            ->method('requireIdErpOrderTotals')
            ->willReturn($this->erpOrderTotalsTransferMock);

        $this->erpOrderTotalsReaderMock->expects(static::atLeastOnce())
            ->method('findErpOrderTotalsByIdErpOrderTotals')
            ->with($idErpOrderTotals)
            ->willReturn($this->existingErpOrderTotalsTransferMock);

        $this->erpOrderTotalsTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($data);

        $this->existingErpOrderTotalsTransferMock->expects(static::atLeastOnce())
            ->method('fromArray')
            ->with($data)
            ->willReturn($this->existingErpOrderTotalsTransferMock);

        $this->erpOrderTotalsWriterMock->expects(static::atLeastOnce())
            ->method('update')
            ->with($this->existingErpOrderTotalsTransferMock)
            ->willReturn($this->existingErpOrderTotalsTransferMock);

        $this->erpOrderTransferMock->expects(static::atLeastOnce())
            ->method('setTotals')
            ->with($this->existingErpOrderTotalsTransferMock)
            ->willReturn($this->erpOrderTransferMock);

        $this->existingErpOrderTotalsTransferMock->expects(static::atLeastOnce())
            ->method('getIdErpOrderTotals')
            ->willReturn($idErpOrderTotals);

        $this->erpOrderTransferMock->expects(static::atLeastOnce())
            ->method('setFkTotals')
            ->with($idErpOrderTotals)
            ->willReturn($this->erpOrderTransferMock);

        static::assertEquals(
            $this->erpOrderTransferMock,
            $this->handler->handle($this->erpOrderTransferMock),
        );
    }
}
