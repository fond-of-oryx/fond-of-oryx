<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Handler;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteItemReaderInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteItemWriterInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteItemCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

class ErpDeliveryNoteItemHandlerTest extends Unit
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
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteItemWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemWriterMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteItemReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemReaderMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteItemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteItemCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteItemCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteItemHandlerInterface
     */
    protected $handler;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->itemWriterMock = $this->getMockBuilder(ErpDeliveryNoteItemWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemReaderMock = $this->getMockBuilder(ErpDeliveryNoteItemReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteTransferMock = $this->getMockBuilder(ErpDeliveryNoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteItemTransferMock = $this->getMockBuilder(ErpDeliveryNoteItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteItemCollectionTransferMock = $this->getMockBuilder(ErpDeliveryNoteItemCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->handler = new ErpDeliveryNoteItemHandler(
            $this->itemWriterMock,
            $this->itemReaderMock,
        );
    }

    /**
     * @return void
     */
    public function testHandleNew(): void
    {
        $items = new ArrayObject([$this->erpDeliveryNoteItemTransferMock]);

        $this->itemReaderMock->expects($this->atLeastOnce())->method('findErpDeliveryNoteItemsByIdErpDeliveryNote')->willReturn($this->erpDeliveryNoteItemCollectionTransferMock);
        $this->erpDeliveryNoteItemCollectionTransferMock->expects($this->once())->method('getItems')->willReturn(new ArrayObject());

        $this->erpDeliveryNoteItemTransferMock->expects($this->atLeastOnce())->method('getSku')->willReturn('sku');
        $this->erpDeliveryNoteItemTransferMock->expects($this->atLeastOnce())->method('getPosition')->willReturn(1);

        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('getIdErpDeliveryNote')->willReturn(1);
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('getDeliveryNoteItems')->willReturn($items);
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('setDeliveryNoteItems')->willReturn($this->erpDeliveryNoteTransferMock);

        $this->itemWriterMock->expects($this->once())->method('create')->willReturn($this->erpDeliveryNoteItemTransferMock);
        $this->itemWriterMock->expects($this->never())->method('delete');
        $this->itemWriterMock->expects($this->never())->method('update');

        $deliveryNote = $this->handler->handle($this->erpDeliveryNoteTransferMock);
    }

    /**
     * @return void
     */
    public function testHandleUpdate(): void
    {
        $existingItem1 = clone $this->erpDeliveryNoteItemTransferMock;
        $items = new ArrayObject([$this->erpDeliveryNoteItemTransferMock]);
        $existingItems = new ArrayObject([$existingItem1]);

        $this->itemReaderMock->expects($this->atLeastOnce())->method('findErpDeliveryNoteItemsByIdErpDeliveryNote')->willReturn($this->erpDeliveryNoteItemCollectionTransferMock);
        $this->erpDeliveryNoteItemCollectionTransferMock->expects($this->atLeastOnce())->method('getItems')->willReturn($existingItems);

        $existingItem1->expects($this->atLeastOnce())->method('getSku')->willReturn('sku');
        $existingItem1->expects($this->atLeastOnce())->method('getPosition')->willReturn(1);
        $existingItem1->expects($this->atLeastOnce())->method('getIdErpDeliveryNoteItem')->willReturn(1);
        $existingItem1->expects($this->atLeastOnce())->method('fromArray');
        $existingItem1->expects($this->atLeastOnce())->method('toArray')->willReturn([]);
        $this->erpDeliveryNoteItemTransferMock->expects($this->atLeastOnce())->method('getSku')->willReturn('sku');
        $this->erpDeliveryNoteItemTransferMock->expects($this->atLeastOnce())->method('getPosition')->willReturn(1);
        $this->erpDeliveryNoteItemTransferMock->expects($this->atLeastOnce())->method('fromArray');
        $this->erpDeliveryNoteItemTransferMock->expects($this->atLeastOnce())->method('toArray')->willReturn([]);
        $this->erpDeliveryNoteItemTransferMock->expects($this->never())->method('getIdErpDeliveryNoteItem');

        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('getIdErpDeliveryNote')->willReturn(1);
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('getDeliveryNoteItems')->willReturn($items);
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('setDeliveryNoteItems')->willReturn($this->erpDeliveryNoteTransferMock);

        $this->itemWriterMock->expects($this->never())->method('create');
        $this->itemWriterMock->expects($this->never())->method('delete');
        $this->itemWriterMock->expects($this->once())->method('update')->willReturn($this->erpDeliveryNoteItemTransferMock);

        $this->itemReaderMock->expects($this->once())->method('findErpDeliveryNoteItemByIdErpDeliveryNoteItem')->willReturn($this->erpDeliveryNoteItemTransferMock);

        $deliveryNote = $this->handler->handle($this->erpDeliveryNoteTransferMock);
    }

    /**
     * @return void
     */
    public function testHandleDelete(): void
    {
        $existingItem1 = clone $this->erpDeliveryNoteItemTransferMock;
        $existingItem2 = clone $this->erpDeliveryNoteItemTransferMock;
        $items = new ArrayObject([$this->erpDeliveryNoteItemTransferMock]);
        $existingItems = new ArrayObject([$existingItem1, $existingItem2]);

        $this->itemReaderMock->expects($this->atLeastOnce())->method('findErpDeliveryNoteItemsByIdErpDeliveryNote')->willReturn($this->erpDeliveryNoteItemCollectionTransferMock);
        $this->erpDeliveryNoteItemCollectionTransferMock->expects($this->atLeastOnce())->method('getItems')->willReturn($existingItems);

        $existingItem1->expects($this->atLeastOnce())->method('getSku')->willReturn('sku');
        $existingItem1->expects($this->atLeastOnce())->method('getPosition')->willReturn(1);
        $existingItem1->expects($this->atLeastOnce())->method('getIdErpDeliveryNoteItem')->willReturn(1);
        $existingItem2->expects($this->atLeastOnce())->method('getSku')->willReturn('sku');
        $existingItem2->expects($this->atLeastOnce())->method('getPosition')->willReturn(2);
        $existingItem2->expects($this->atLeastOnce())->method('getIdErpDeliveryNoteItem')->willReturn(2);
        $this->erpDeliveryNoteItemTransferMock->expects($this->atLeastOnce())->method('getSku')->willReturn('sku1');

        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('getIdErpDeliveryNote')->willReturn(1);
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('getDeliveryNoteItems')->willReturn($items);
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('setDeliveryNoteItems')->willReturn($this->erpDeliveryNoteTransferMock);

        $this->itemWriterMock->expects($this->atLeastOnce())->method('create')->willReturn($this->erpDeliveryNoteItemTransferMock);
        $this->itemWriterMock->expects($this->exactly(2))->method('delete');
        $this->itemWriterMock->expects($this->never())->method('update');

        $deliveryNote = $this->handler->handle($this->erpDeliveryNoteTransferMock);
    }
}
