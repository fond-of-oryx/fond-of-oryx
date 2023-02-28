<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Handler;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteTrackingReaderInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteTrackingWriterInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTrackingCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

class ErpDeliveryNoteTrackingHandlerTest extends Unit
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
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteTrackingWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $trackingWriterMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteTrackingReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $trackingReaderMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteTrackingTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteItemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteTrackingCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteTrackingCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteTrackingHandlerInterface
     */
    protected $handler;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->trackingWriterMock = $this->getMockBuilder(ErpDeliveryNoteTrackingWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->trackingReaderMock = $this->getMockBuilder(ErpDeliveryNoteTrackingReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteTransferMock = $this->getMockBuilder(ErpDeliveryNoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteItemTransferMock = $this->getMockBuilder(ErpDeliveryNoteItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteTrackingTransferMock = $this->getMockBuilder(ErpDeliveryNoteTrackingTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteTrackingCollectionTransferMock = $this->getMockBuilder(ErpDeliveryNoteTrackingCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->handler = new ErpDeliveryNoteTrackingHandler(
            $this->trackingWriterMock,
            $this->trackingReaderMock,
        );
    }

    /**
     * @return void
     */
    public function testHandleNew(): void
    {
        $items = new ArrayObject([$this->erpDeliveryNoteItemTransferMock]);
        $tracking = new ArrayObject([$this->erpDeliveryNoteTrackingTransferMock]);
        $trackingNumber = '12345';
        $qty = 2.0;
        $orderId = 99;

        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('requireIdErpDeliveryNote')->willReturnSelf();
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('getIdErpDeliveryNote')->willReturn($orderId);
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('getDeliveryNoteItems')->willReturn($items);
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('setTracking')->willReturnSelf();
        $this->erpDeliveryNoteItemTransferMock->expects($this->atLeastOnce())->method('getTrackingData')->willReturn($tracking);
        $this->erpDeliveryNoteTrackingTransferMock->expects($this->atLeastOnce())->method('getTrackingNumber')->willReturn($trackingNumber);
        $this->erpDeliveryNoteTrackingTransferMock->expects($this->atLeastOnce())->method('getQuantity')->willReturn($qty);
        $this->erpDeliveryNoteTrackingTransferMock->expects($this->atLeastOnce())->method('addItemRelation')->willReturnSelf();
        $this->erpDeliveryNoteTrackingTransferMock->expects($this->atLeastOnce())->method('setFkErpDeliveryNote')->with($orderId)->willReturnSelf();
        $this->erpDeliveryNoteTrackingCollectionTransferMock->expects($this->atLeastOnce())->method('getTracking')->willReturn([]);

        $this->trackingReaderMock->expects($this->once())->method('findErpDeliveryNoteTrackingByIdErpDeliveryNote')->willReturn($this->erpDeliveryNoteTrackingCollectionTransferMock);
        $this->trackingWriterMock->expects($this->once())->method('create')->willReturn($this->erpDeliveryNoteTrackingTransferMock);
        $this->trackingWriterMock->expects($this->never())->method('delete');
        $this->trackingWriterMock->expects($this->never())->method('update');

        $deliveryNote = $this->handler->handle($this->erpDeliveryNoteTransferMock);
    }

    /**
     * @return void
     */
    public function testHandleUpdate(): void
    {
        $items = new ArrayObject([$this->erpDeliveryNoteItemTransferMock]);
        $tracking = new ArrayObject([$this->erpDeliveryNoteTrackingTransferMock]);
        $trackingNumber = '12345';
        $qty = 2.0;
        $orderId = 99;
        $trackingId = 1;

        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('requireIdErpDeliveryNote')->willReturnSelf();
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('getIdErpDeliveryNote')->willReturn($orderId);
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('getDeliveryNoteItems')->willReturn($items);
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('setTracking')->willReturnSelf();
        $this->erpDeliveryNoteItemTransferMock->expects($this->atLeastOnce())->method('getTrackingData')->willReturn($tracking);
        $this->erpDeliveryNoteTrackingTransferMock->expects($this->atLeastOnce())->method('getTrackingNumber')->willReturn($trackingNumber);
        $this->erpDeliveryNoteTrackingTransferMock->expects($this->atLeastOnce())->method('getQuantity')->willReturn($qty);
        $this->erpDeliveryNoteTrackingTransferMock->expects($this->atLeastOnce())->method('addItemRelation')->willReturnSelf();
        $this->erpDeliveryNoteTrackingTransferMock->expects($this->atLeastOnce())->method('setFkErpDeliveryNote')->with($orderId)->willReturnSelf();
        $this->erpDeliveryNoteTrackingTransferMock->expects($this->atLeastOnce())->method('toArray')->willReturn([]);
        $this->erpDeliveryNoteTrackingTransferMock->expects($this->atLeastOnce())->method('getIdErpDeliveryNoteTracking')->willReturn($trackingId);

        $this->trackingReaderMock->expects($this->once())->method('findErpDeliveryNoteTrackingByIdErpDeliveryNoteTracking')->willReturn($this->erpDeliveryNoteTrackingTransferMock);
        $this->trackingWriterMock->expects($this->never())->method('create');
        $this->trackingWriterMock->expects($this->never())->method('delete');
        $this->trackingWriterMock->expects($this->once())->method('update')->willReturn($this->erpDeliveryNoteTrackingTransferMock);

        $deliveryNote = $this->handler->handle($this->erpDeliveryNoteTransferMock, $this->erpDeliveryNoteTransferMock);
    }

    /**
     * @return void
     */
    public function testHandleDelete(): void
    {
        $items = new ArrayObject([$this->erpDeliveryNoteItemTransferMock]);
        $trackingClone = clone $this->erpDeliveryNoteTrackingTransferMock;
        $tracking = new ArrayObject([$this->erpDeliveryNoteTrackingTransferMock, $trackingClone]);
        $trackingNumber = '12345';
        $qty = 2.0;
        $orderId = 99;
        $trackingId = 1;

        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('requireIdErpDeliveryNote')->willReturnSelf();
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('getIdErpDeliveryNote')->willReturn($orderId);
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('getDeliveryNoteItems')->willReturn($items);
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('setTracking')->willReturnSelf();
        $this->erpDeliveryNoteItemTransferMock->expects($this->atLeastOnce())->method('getTrackingData')->willReturn($tracking);
        $this->erpDeliveryNoteTrackingTransferMock->expects($this->atLeastOnce())->method('getTrackingNumber')->willReturn($trackingNumber);
        $this->erpDeliveryNoteTrackingTransferMock->expects($this->atLeastOnce())->method('getQuantity')->willReturn($qty);
        $this->erpDeliveryNoteTrackingTransferMock->expects($this->atLeastOnce())->method('addItemRelation')->willReturnSelf();
        $this->erpDeliveryNoteTrackingTransferMock->expects($this->atLeastOnce())->method('setFkErpDeliveryNote')->with($orderId)->willReturnSelf();
        $this->erpDeliveryNoteTrackingTransferMock->expects($this->atLeastOnce())->method('toArray')->willReturn([]);
        $this->erpDeliveryNoteTrackingTransferMock->expects($this->atLeastOnce())->method('getIdErpDeliveryNoteTracking')->willReturn($trackingId);
        $this->erpDeliveryNoteTrackingTransferMock->expects($this->atLeastOnce())->method('setIdErpDeliveryNoteTracking')->willReturnSelf();
        $trackingClone->expects($this->atLeastOnce())->method('getTrackingNumber')->willReturn($trackingNumber);
        $trackingClone->expects($this->atLeastOnce())->method('getQuantity')->willReturn(2);
        $trackingClone->expects($this->atLeastOnce())->method('addItemRelation')->willReturnSelf();
        $trackingClone->expects($this->atLeastOnce())->method('setIdErpDeliveryNoteTracking')->willReturnSelf();
        $trackingClone->expects($this->atLeastOnce())->method('toArray')->willReturn([]);
        $trackingClone->expects($this->atLeastOnce())->method('getIdErpDeliveryNoteTracking')->willReturn(44);

        $this->trackingReaderMock->expects($this->once())->method('findErpDeliveryNoteTrackingByIdErpDeliveryNoteTracking')->willReturn($this->erpDeliveryNoteTrackingTransferMock);
        $this->trackingWriterMock->expects($this->never())->method('create');
        $this->trackingWriterMock->expects($this->never())->method('delete');
        $this->trackingWriterMock->expects($this->once())->method('update')->willReturn($this->erpDeliveryNoteTrackingTransferMock);

        $deliveryNote = $this->handler->handle($this->erpDeliveryNoteTransferMock, $this->erpDeliveryNoteTransferMock);
    }

//    /**
//     * @return void
//     */
//    public function testHandleDelete(): void
//    {
//        $existingItem1 = clone $this->erpDeliveryNoteItemTransferMock;
//        $existingItem2 = clone $this->erpDeliveryNoteItemTransferMock;
//        $items = new ArrayObject([$this->erpDeliveryNoteItemTransferMock]);
//        $existingItems = new ArrayObject([$existingItem1, $existingItem2]);
//
//        $this->trackingReaderMock->expects($this->atLeastOnce())->method('findErpDeliveryNoteTrackingsByIdErpDeliveryNote')->willReturn($this->erpDeliveryNoteTrackingCollectionTransferMock);
//        $this->erpDeliveryNoteTrackingCollectionTransferMock->expects($this->atLeastOnce())->method('getItems')->willReturn($existingItems);
//
//        $existingItem1->expects($this->atLeastOnce())->method('getSku')->willReturn('sku');
//        $existingItem1->expects($this->atLeastOnce())->method('getPosition')->willReturn(1);
//        $existingItem1->expects($this->atLeastOnce())->method('getIdErpDeliveryNoteTracking')->willReturn(1);
//        $existingItem2->expects($this->atLeastOnce())->method('getSku')->willReturn('sku');
//        $existingItem2->expects($this->atLeastOnce())->method('getPosition')->willReturn(2);
//        $existingItem2->expects($this->atLeastOnce())->method('getIdErpDeliveryNoteTracking')->willReturn(2);
//        $this->erpDeliveryNoteItemTransferMock->expects($this->atLeastOnce())->method('getSku')->willReturn('sku1');
//
//        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('getIdErpDeliveryNote')->willReturn(1);
//        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('getDeliveryNoteItems')->willReturn($items);
//        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('setDeliveryNoteItems')->willReturn($this->erpDeliveryNoteTransferMock);
//
//        $this->trackingWriterMock->expects($this->atLeastOnce())->method('create')->willReturn($this->erpDeliveryNoteItemTransferMock);
//        $this->trackingWriterMock->expects($this->exactly(2))->method('delete');
//        $this->trackingWriterMock->expects($this->never())->method('update');
//
//        $deliveryNote = $this->handler->handle($this->erpDeliveryNoteTransferMock);
//    }
}
