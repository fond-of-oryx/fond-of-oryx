<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Handler;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderItemReaderInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderItemWriterInterface;
use Generated\Shared\Transfer\ErpOrderItemCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

class ErpOrderItemHandlerTest extends Unit
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
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderItemWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemWriterMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderItemReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemReaderMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderItemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderItemCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderItemCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderItemHandlerInterface
     */
    protected $handler;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->itemWriterMock = $this->getMockBuilder(ErpOrderItemWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemReaderMock = $this->getMockBuilder(ErpOrderItemReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderTransferMock = $this->getMockBuilder(ErpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderItemTransferMock = $this->getMockBuilder(ErpOrderItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderItemCollectionTransferMock = $this->getMockBuilder(ErpOrderItemCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->handler = new ErpOrderItemHandler(
            $this->itemWriterMock,
            $this->itemReaderMock,
        );
    }

    /**
     * @return void
     */
    public function testHandleNew(): void
    {
        $items = new ArrayObject([$this->erpOrderItemTransferMock]);

        $this->itemReaderMock->expects($this->atLeastOnce())->method('findErpOrderItemsByIdErpOrder')->willReturn($this->erpOrderItemCollectionTransferMock);
        $this->erpOrderItemCollectionTransferMock->expects($this->once())->method('getItems')->willReturn(new ArrayObject());

        $this->erpOrderItemTransferMock->expects($this->atLeastOnce())->method('getSku')->willReturn(3);

        $this->erpOrderTransferMock->expects($this->atLeastOnce())->method('getIdErpOrder')->willReturn(1);
        $this->erpOrderTransferMock->expects($this->atLeastOnce())->method('getOrderItems')->willReturn($items);
        $this->erpOrderTransferMock->expects($this->atLeastOnce())->method('setOrderItems')->willReturn($this->erpOrderTransferMock);

        $this->itemWriterMock->expects($this->once())->method('create')->willReturn($this->erpOrderItemTransferMock);
        $this->itemWriterMock->expects($this->never())->method('delete');
        $this->itemWriterMock->expects($this->never())->method('update');

        $order = $this->handler->handle($this->erpOrderTransferMock);
    }

    /**
     * @return void
     */
    public function testHandleUpdate(): void
    {
        $existingItem1 = clone $this->erpOrderItemTransferMock;
        $items = new ArrayObject([$this->erpOrderItemTransferMock]);
        $existingItems = new ArrayObject([$existingItem1]);

        $this->itemReaderMock->expects($this->atLeastOnce())->method('findErpOrderItemsByIdErpOrder')->willReturn($this->erpOrderItemCollectionTransferMock);
        $this->erpOrderItemCollectionTransferMock->expects($this->atLeastOnce())->method('getItems')->willReturn($existingItems);

        $existingItem1->expects($this->atLeastOnce())->method('getSku')->willReturn(1);
        $existingItem1->expects($this->atLeastOnce())->method('getIdErpOrderItem')->willReturn(1);
        $existingItem1->expects($this->atLeastOnce())->method('fromArray');
        $existingItem1->expects($this->atLeastOnce())->method('toArray')->willReturn([]);
        $this->erpOrderItemTransferMock->expects($this->atLeastOnce())->method('getSku')->willReturn(1);
        $this->erpOrderItemTransferMock->expects($this->atLeastOnce())->method('fromArray')->willReturn($this->erpOrderItemTransferMock);
        $this->erpOrderItemTransferMock->expects($this->atLeastOnce())->method('setCreatedAt')->willReturn($this->erpOrderItemTransferMock);
        $this->erpOrderItemTransferMock->expects($this->atLeastOnce())->method('toArray')->willReturn([]);

        $this->erpOrderTransferMock->expects($this->atLeastOnce())->method('getIdErpOrder')->willReturn(1);
        $this->erpOrderTransferMock->expects($this->atLeastOnce())->method('getOrderItems')->willReturn($items);
        $this->erpOrderTransferMock->expects($this->atLeastOnce())->method('setOrderItems')->willReturn($this->erpOrderTransferMock);

        $this->itemWriterMock->expects($this->once())->method('update')->willReturn($this->erpOrderItemTransferMock);

        $this->itemReaderMock->expects($this->once())->method('findErpOrderItemByIdErpOrderItem')->willReturn($this->erpOrderItemTransferMock);
        $this->erpOrderItemTransferMock->expects($this->once())->method('getCreatedAt')->willReturn(time());

        $order = $this->handler->handle($this->erpOrderTransferMock);
    }

    /**
     * @return void
     */
    public function testHandleDelete(): void
    {
        $existingItem1 = clone $this->erpOrderItemTransferMock;
        $existingItem2 = clone $this->erpOrderItemTransferMock;
        $items = new ArrayObject();
        $existingItems = new ArrayObject([$existingItem1, $existingItem2]);

        $this->itemReaderMock->expects($this->atLeastOnce())->method('findErpOrderItemsByIdErpOrder')->willReturn($this->erpOrderItemCollectionTransferMock);
        $this->erpOrderItemCollectionTransferMock->expects($this->atLeastOnce())->method('getItems')->willReturn($existingItems);

        $existingItem1->expects($this->atLeastOnce())->method('getSku')->willReturn(1);
        $existingItem1->expects($this->atLeastOnce())->method('getIdErpOrderItem')->willReturn(1);
        $existingItem2->expects($this->atLeastOnce())->method('getSku')->willReturn(2);
        $existingItem2->expects($this->atLeastOnce())->method('getIdErpOrderItem')->willReturn(2);

        $this->erpOrderTransferMock->expects($this->atLeastOnce())->method('getIdErpOrder')->willReturn(1);
        $this->erpOrderTransferMock->expects($this->atLeastOnce())->method('getOrderItems')->willReturn($items);
        $this->erpOrderTransferMock->expects($this->atLeastOnce())->method('setOrderItems')->willReturn($this->erpOrderTransferMock);

        $this->itemWriterMock->expects($this->never())->method('create');
        $this->itemWriterMock->expects($this->exactly(2))->method('delete');
        $this->itemWriterMock->expects($this->never())->method('update');

        $order = $this->handler->handle($this->erpOrderTransferMock);
    }
}
