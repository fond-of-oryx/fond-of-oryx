<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Handler;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceItemReaderInterface;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceItemWriterInterface;
use Generated\Shared\Transfer\ErpInvoiceItemCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoiceItemTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

class ErpInvoiceItemHandlerTest extends Unit
{
    /**
     * @var string
     */
    protected const NEW = 'new';

    /**
     * @var string
     */
    protected const UPDATE = 'update';

    /**
     * @var string
     */
    protected const DELETE = 'delete';

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceItemWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemWriterMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceItemReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemReaderMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceItemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceItemCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceItemCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceItemHandlerInterface
     */
    protected $handler;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->itemWriterMock = $this->getMockBuilder(ErpInvoiceItemWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemReaderMock = $this->getMockBuilder(ErpInvoiceItemReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceTransferMock = $this->getMockBuilder(ErpInvoiceTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceItemTransferMock = $this->getMockBuilder(ErpInvoiceItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceItemCollectionTransferMock = $this->getMockBuilder(ErpInvoiceItemCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->handler = new ErpInvoiceItemHandler(
            $this->itemWriterMock,
            $this->itemReaderMock,
        );
    }

    /**
     * @return void
     */
    public function testHandleNew(): void
    {
        $items = new ArrayObject([$this->erpInvoiceItemTransferMock]);

        $this->itemReaderMock->expects($this->atLeastOnce())->method('findErpInvoiceItemsByIdErpInvoice')->willReturn($this->erpInvoiceItemCollectionTransferMock);
        $this->erpInvoiceItemCollectionTransferMock->expects($this->once())->method('getItems')->willReturn(new ArrayObject());

        $this->erpInvoiceItemTransferMock->expects($this->atLeastOnce())->method('getSku')->willReturn('sku');
        $this->erpInvoiceItemTransferMock->expects($this->atLeastOnce())->method('getPosition')->willReturn(1);

        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())->method('getIdErpInvoice')->willReturn(1);
        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())->method('getInvoiceItems')->willReturn($items);
        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())->method('setInvoiceItems')->willReturn($this->erpInvoiceTransferMock);

        $this->itemWriterMock->expects($this->once())->method('create')->willReturn($this->erpInvoiceItemTransferMock);
        $this->itemWriterMock->expects($this->never())->method('delete');
        $this->itemWriterMock->expects($this->never())->method('update');

        $invoice = $this->handler->handle($this->erpInvoiceTransferMock);
    }

    /**
     * @return void
     */
    public function testHandleUpdate(): void
    {
        $existingItem1 = clone $this->erpInvoiceItemTransferMock;
        $items = new ArrayObject([$this->erpInvoiceItemTransferMock]);
        $existingItems = new ArrayObject([$existingItem1]);

        $this->itemReaderMock->expects($this->atLeastOnce())->method('findErpInvoiceItemsByIdErpInvoice')->willReturn($this->erpInvoiceItemCollectionTransferMock);
        $this->erpInvoiceItemCollectionTransferMock->expects($this->atLeastOnce())->method('getItems')->willReturn($existingItems);

        $existingItem1->expects($this->atLeastOnce())->method('getSku')->willReturn('sku');
//        $existingItem1->expects($this->atLeastOnce())->method('getPosition')->willReturn(1);
        $existingItem1->expects($this->atLeastOnce())->method('getIdErpInvoiceItem')->willReturn(1);
        $existingItem1->expects($this->atLeastOnce())->method('fromArray');
        $existingItem1->expects($this->atLeastOnce())->method('toArray')->willReturn([]);
        $this->erpInvoiceItemTransferMock->expects($this->atLeastOnce())->method('getSku')->willReturn('sku');
//        $this->erpInvoiceItemTransferMock->expects($this->atLeastOnce())->method('getPosition')->willReturn(2);
        $this->erpInvoiceItemTransferMock->expects($this->atLeastOnce())->method('fromArray');
        $this->erpInvoiceItemTransferMock->expects($this->atLeastOnce())->method('toArray')->willReturn([]);
        $this->erpInvoiceItemTransferMock->expects($this->never())->method('getIdErpInvoiceItem');

        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())->method('getIdErpInvoice')->willReturn(1);
        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())->method('getInvoiceItems')->willReturn($items);
        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())->method('setInvoiceItems')->willReturn($this->erpInvoiceTransferMock);

        $this->itemWriterMock->expects($this->never())->method('create');
        $this->itemWriterMock->expects($this->never())->method('delete');
        $this->itemWriterMock->expects($this->once())->method('update')->willReturn($this->erpInvoiceItemTransferMock);

        $this->itemReaderMock->expects($this->once())->method('findErpInvoiceItemByIdErpInvoiceItem')->willReturn($this->erpInvoiceItemTransferMock);

        $invoice = $this->handler->handle($this->erpInvoiceTransferMock);
    }

    /**
     * @return void
     */
    public function testHandleDelete(): void
    {
        $existingItem1 = clone $this->erpInvoiceItemTransferMock;
        $existingItem2 = clone $this->erpInvoiceItemTransferMock;
        $items = new ArrayObject([$this->erpInvoiceItemTransferMock]);
        $existingItems = new ArrayObject([$existingItem1, $existingItem2]);

        $this->itemReaderMock->expects($this->atLeastOnce())->method('findErpInvoiceItemsByIdErpInvoice')->willReturn($this->erpInvoiceItemCollectionTransferMock);
        $this->erpInvoiceItemCollectionTransferMock->expects($this->atLeastOnce())->method('getItems')->willReturn($existingItems);

        $existingItem1->expects($this->atLeastOnce())->method('getSku')->willReturn('sku');
        $existingItem1->expects($this->atLeastOnce())->method('getPosition')->willReturn(1);
        $existingItem1->expects($this->atLeastOnce())->method('getIdErpInvoiceItem')->willReturn(1);
        $existingItem2->expects($this->atLeastOnce())->method('getSku')->willReturn('sku');
        $existingItem2->expects($this->atLeastOnce())->method('getPosition')->willReturn(2);
        $existingItem2->expects($this->atLeastOnce())->method('getIdErpInvoiceItem')->willReturn(2);
        $this->erpInvoiceItemTransferMock->expects($this->atLeastOnce())->method('getSku')->willReturn(3);

        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())->method('getIdErpInvoice')->willReturn(1);
        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())->method('getInvoiceItems')->willReturn($items);
        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())->method('setInvoiceItems')->willReturn($this->erpInvoiceTransferMock);

        $this->itemWriterMock->expects($this->atLeastOnce())->method('create')->willReturn($this->erpInvoiceItemTransferMock);
        $this->itemWriterMock->expects($this->exactly(2))->method('delete');
        $this->itemWriterMock->expects($this->never())->method('update');

        $invoice = $this->handler->handle($this->erpInvoiceTransferMock);
    }
}
