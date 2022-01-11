<?php

namespace FondOfOryx\Zed\Invoice\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\Invoice\Persistence\InvoiceEntityManager;
use Generated\Shared\Transfer\InvoiceTransfer;
use Generated\Shared\Transfer\ItemTransfer;

class InvoiceItemsWriterTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\Persistence\InvoiceEntityManager
     */
    protected $entityManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\InvoiceTransfer
     */
    protected $invoiceTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ItemTransfer
     */
    protected $itemTransferMock;

    /**
     * @var \FondOfOryx\Zed\Invoice\Business\Model\InvoiceItemsWriterInterface
     */
    protected $invoiceItemsWriter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(InvoiceEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceTransferMock = $this->getMockBuilder(InvoiceTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceItemsWriter = new InvoiceItemsWriter($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->invoiceTransferMock->expects(static::atLeastOnce())
            ->method('requireIdInvoice')
            ->willReturnSelf();

        $this->invoiceTransferMock->expects(static::atLeastOnce())
            ->method('requireItems')
            ->willReturnSelf();

        $this->invoiceTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn([$this->itemTransferMock]);

        $this->invoiceTransferMock->expects(static::atLeastOnce())
            ->method('getIdInvoice')
            ->willReturn(1);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('setFkInvoice')
            ->with(1)
            ->willReturnSelf();

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createInvoiceItem')
            ->with($this->itemTransferMock)
            ->willReturn($this->itemTransferMock);

        static::assertEquals($this->invoiceTransferMock, $this->invoiceItemsWriter->create($this->invoiceTransferMock));
    }
}
