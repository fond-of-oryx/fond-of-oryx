<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Handler;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceReaderInterface;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceAmountWriterInterface;
use Generated\Shared\Transfer\ErpInvoiceAmountTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

class ErpInvoiceAmountHandlerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceAmountWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceTotalWriterMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceReaderMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceAmountTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceTotalTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceAmountHandlerInterface
     */
    protected $handler;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->erpInvoiceTotalWriterMock = $this->getMockBuilder(ErpInvoiceAmountWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceReaderMock = $this->getMockBuilder(ErpInvoiceReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceTransferMock = $this->getMockBuilder(ErpInvoiceTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceTotalTransferMock = $this->getMockBuilder(ErpInvoiceAmountTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->handler = new ErpInvoiceAmountHandler(
            $this->erpInvoiceTotalWriterMock,
            $this->erpInvoiceReaderMock,
        );
    }

    /**
     * @return void
     */
    public function testHandleCreate(): void
    {
        $idErpInvoice = 1;

        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())
            ->method('getIdErpInvoice')
            ->willReturn($idErpInvoice);

        $this->erpInvoiceReaderMock->expects($this->once())
            ->method('findErpInvoiceByIdErpInvoice')
            ->with($idErpInvoice)
            ->willReturn(null);

        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())
            ->method('getTotal')
            ->willReturn($this->erpInvoiceTotalTransferMock);

        $this->erpInvoiceTotalWriterMock->expects($this->atLeastOnce())
            ->method('create')
            ->with($this->erpInvoiceTotalTransferMock)
            ->willReturn($this->erpInvoiceTotalTransferMock);

        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())
            ->method('setTotal')
            ->with($this->erpInvoiceTotalTransferMock)
            ->willReturn($this->erpInvoiceTransferMock);

        $erpInvoiceTransfer = $this->handler->handle($this->erpInvoiceTransferMock);

        $this->assertInstanceOf(ErpInvoiceTransfer::class, $erpInvoiceTransfer);
    }

    /**
     * @return void
     */
    public function testHandleUpdate(): void
    {
        $idErpInvoice = 1;
        $idErpInvoiceAmount = 1;

        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())
            ->method('getIdErpInvoice')
            ->willReturn($idErpInvoice);

        $this->erpInvoiceReaderMock->expects($this->once())
            ->method('findErpInvoiceByIdErpInvoice')
            ->with($idErpInvoice)
            ->willReturn($this->erpInvoiceTransferMock);

        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())
            ->method('getTotal')
            ->willReturn($this->erpInvoiceTotalTransferMock);

        $this->erpInvoiceTotalTransferMock->expects($this->atLeastOnce())
            ->method('setValue')
            ->willReturnSelf();

        $this->erpInvoiceTotalTransferMock->expects($this->atLeastOnce())
            ->method('setTax')
            ->willReturnSelf();

        $this->erpInvoiceReaderMock->expects($this->once())
            ->method('findErpInvoiceByIdErpInvoice')
            ->with($idErpInvoice)
            ->willReturn($this->erpInvoiceTransferMock);

        $this->erpInvoiceTotalWriterMock->expects($this->atLeastOnce())
            ->method('update')
            ->with($this->erpInvoiceTotalTransferMock)
            ->willReturn($this->erpInvoiceTotalTransferMock);

        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())
            ->method('setTotal')
            ->willReturn($this->erpInvoiceTransferMock);

        $erpInvoiceTransfer = $this->handler->handle($this->erpInvoiceTransferMock);

        $this->assertInstanceOf(ErpInvoiceTransfer::class, $erpInvoiceTransfer);
    }
}
