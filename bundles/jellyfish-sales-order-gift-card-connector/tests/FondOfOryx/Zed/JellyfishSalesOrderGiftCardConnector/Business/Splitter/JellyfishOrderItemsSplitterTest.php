<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Splitter;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemGiftCard;
use Propel\Runtime\Collection\CollectionIterator;
use Propel\Runtime\Collection\ObjectCollection;

class JellyfishOrderItemsSplitterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Splitter\JellyfishOrderItemsSplitterInterface
     */
    protected $jellyfishOrderItemsSplitter;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\JellyfishOrderItemTransfer
     */
    protected $jellyfishOrderItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrder
     */
    protected $salesOrderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Propel\Runtime\Collection\ObjectCollection
     */
    protected $salesOrderItemCollectionMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Propel\Runtime\Collection\CollectionIterator
     */
    protected $salesOrderItemIteratorMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrderItem>
     */
    protected $salesOrderItemMocks;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject|\Propel\Runtime\Collection\ObjectCollection>
     */
    protected $salesOrderItemGiftCardCollectionMocks;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrderItemGiftCard>
     */
    protected $salesOrderItemGiftCardMocks;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->jellyfishOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderItemTransferMock = $this->getMockBuilder(JellyfishOrderItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderItemCollectionMock = $this->getMockBuilder(ObjectCollection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderItemIteratorMock = $this->getMockBuilder(CollectionIterator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderItemMocks = [
            $this->getMockBuilder(SpySalesOrderItem::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(SpySalesOrderItem::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->salesOrderItemGiftCardCollectionMocks = [
            $this->getMockBuilder(ObjectCollection::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ObjectCollection::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->salesOrderItemGiftCardMocks = [
            $this->getMockBuilder(SpySalesOrderItemGiftCard::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(SpySalesOrderItemGiftCard::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->jellyfishOrderItemsSplitter = new JellyfishOrderItemsSplitter();
    }

    /**
     * @return void
     */
    public function testSplitGiftCardOrderItems(): void
    {
        $jellyfishOrderItems = new ArrayObject();
        $jellyfishOrderItems->append($this->jellyfishOrderItemTransferMock);

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn($jellyfishOrderItems);

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('getProductType')
            ->willReturn('gift_card');

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('getQuantity')
            ->willReturn(2);

        $this->salesOrderMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn($this->salesOrderItemCollectionMock);

        $this->salesOrderItemCollectionMock->expects(static::atLeastOnce())
            ->method('getIterator')
            ->willReturn($this->salesOrderItemIteratorMock);

        $this->salesOrderItemIteratorMock->expects(static::atLeastOnce())
            ->method('rewind');

        $this->salesOrderItemIteratorMock->expects(static::atLeastOnce())
            ->method('valid')
            ->willReturnOnConsecutiveCalls(true, true, false);

        $this->salesOrderItemIteratorMock->expects(static::atLeastOnce())
            ->method('current')
            ->willReturnOnConsecutiveCalls($this->salesOrderItemMocks[0], $this->salesOrderItemMocks[1]);

        $this->salesOrderItemIteratorMock->expects(static::atLeastOnce())
            ->method('next');

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('sku');

        $this->salesOrderItemMocks[0]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('sku');

        $this->salesOrderItemMocks[1]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('sku');

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn(1);

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('setId')
            ->willReturnSelf();

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('setQuantity')
            ->willReturnSelf();

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('setSumPrice')
            ->willReturnSelf();

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('setSumPriceToPayAggregation')
            ->willReturnSelf();

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('setSumTaxAmount')
            ->willReturnSelf();

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('setGiftCardCode')
            ->willReturnSelf();

        $this->salesOrderItemMocks[0]->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn(1);

        $this->salesOrderItemMocks[1]->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn(2);

        $this->salesOrderItemMocks[0]->expects(static::atLeastOnce())
            ->method('getPrice')
            ->willReturn(1000);

        $this->salesOrderItemMocks[1]->expects(static::atLeastOnce())
            ->method('getPrice')
            ->willReturn(1000);

        $this->salesOrderItemMocks[0]->expects(static::atLeastOnce())
            ->method('getPrice')
            ->willReturn(1000);

        $this->salesOrderItemMocks[1]->expects(static::atLeastOnce())
            ->method('getPrice')
            ->willReturn(1000);

        $this->salesOrderItemMocks[0]->expects(static::atLeastOnce())
            ->method('getPriceToPayAggregation')
            ->willReturn(1000);

        $this->salesOrderItemMocks[1]->expects(static::atLeastOnce())
            ->method('getPriceToPayAggregation')
            ->willReturn(1000);

        $this->salesOrderItemMocks[0]->expects(static::atLeastOnce())
            ->method('getTaxAmount')
            ->willReturn(100);

        $this->salesOrderItemMocks[1]->expects(static::atLeastOnce())
            ->method('getTaxAmount')
            ->willReturn(100);

        $this->salesOrderItemMocks[0]->expects(static::atLeastOnce())
            ->method('getSpySalesOrderItemGiftCards')
            ->willReturn($this->salesOrderItemGiftCardCollectionMocks[0]);

        $this->salesOrderItemMocks[1]->expects(static::atLeastOnce())
            ->method('getSpySalesOrderItemGiftCards')
            ->willReturn($this->salesOrderItemGiftCardCollectionMocks[1]);

        $this->salesOrderItemGiftCardCollectionMocks[0]->expects(static::atLeastOnce())
            ->method('getFirst')
            ->willReturn($this->salesOrderItemGiftCardMocks[0]);

        $this->salesOrderItemGiftCardCollectionMocks[1]->expects(static::atLeastOnce())
            ->method('getFirst')
            ->willReturn($this->salesOrderItemGiftCardMocks[1]);

        $this->salesOrderItemGiftCardMocks[0]->expects(static::atLeastOnce())
            ->method('getCode')
            ->willReturn('code1');

        $this->salesOrderItemGiftCardMocks[1]->expects(static::atLeastOnce())
            ->method('getCode')
            ->willReturn('code2');

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
           ->method('toArray')
           ->willReturn([]);

        $jellyfishOrderTransfer = $this->jellyfishOrderItemsSplitter
            ->splitGiftCardOrderItems($this->jellyfishOrderTransferMock, $this->salesOrderMock);

        $this->assertInstanceOf(JellyfishOrderTransfer::class, $jellyfishOrderTransfer);
        $this->assertEquals(2, count($jellyfishOrderTransfer->getItems()));
    }
}
