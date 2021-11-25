<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Splitter;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemGiftCard;
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
    protected $spySalesOrderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrderItem
     */
    protected $spySalesOrderItemMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrderItemGiftCard
     */
    protected $spySalesOrderItemGiftCardMock;

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

        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderItemMock = $this->getMockBuilder(SpySalesOrderItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderItemGiftCardMock = $this->getMockBuilder(SpySalesOrderItemGiftCard::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderItemsSplitter = new JellyfishOrderItemsSplitter();
    }

    /**
     * @return void
     */
    public function testSplitGiftCardOrderItems(): void
    {
        $jellyfishOrderItems = new ArrayObject();
        $jellyfishOrderItems->append($this->jellyfishOrderItemTransferMock);

        $spySalesOrderItem1Mock = clone $this->spySalesOrderItemMock;
        $spySalesOrderItem2Mock = clone $this->spySalesOrderItemMock;

        $salesOrderItems = new ObjectCollection();
        $salesOrderItems->append($spySalesOrderItem1Mock);
        $salesOrderItems->append($spySalesOrderItem2Mock);

        $spySalesOrderItemGiftCard1Mock = clone $this->spySalesOrderItemGiftCardMock;
        $spySalesOrderItemGiftCard2Mock = clone $this->spySalesOrderItemGiftCardMock;

        $salesOrderItem1GiftCards = new ObjectCollection();
        $salesOrderItem1GiftCards->append($spySalesOrderItemGiftCard1Mock);

        $salesOrderItem2GiftCards = new ObjectCollection();
        $salesOrderItem2GiftCards->append($spySalesOrderItemGiftCard2Mock);

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn($jellyfishOrderItems);

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('getProductType')
            ->willReturn('gift_card');

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('getQuantity')
            ->willReturn(2);

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn($salesOrderItems);

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('sku');

        $spySalesOrderItem1Mock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('sku');

        $spySalesOrderItem2Mock->expects(static::atLeastOnce())
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

        $spySalesOrderItem1Mock->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn(1);

        $spySalesOrderItem2Mock->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn(2);

        $spySalesOrderItem1Mock->expects(static::atLeastOnce())
            ->method('getPrice')
            ->willReturn(1000);

        $spySalesOrderItem2Mock->expects(static::atLeastOnce())
            ->method('getPrice')
            ->willReturn(1000);

        $spySalesOrderItem1Mock->expects(static::atLeastOnce())
            ->method('getPrice')
            ->willReturn(1000);

        $spySalesOrderItem2Mock->expects(static::atLeastOnce())
            ->method('getPrice')
            ->willReturn(1000);

        $spySalesOrderItem1Mock->expects(static::atLeastOnce())
            ->method('getPriceToPayAggregation')
            ->willReturn(1000);

        $spySalesOrderItem2Mock->expects(static::atLeastOnce())
            ->method('getPriceToPayAggregation')
            ->willReturn(1000);

        $spySalesOrderItem1Mock->expects(static::atLeastOnce())
            ->method('getTaxAmount')
            ->willReturn(100);

        $spySalesOrderItem2Mock->expects(static::atLeastOnce())
            ->method('getTaxAmount')
            ->willReturn(100);

        $spySalesOrderItem1Mock->expects(static::atLeastOnce())
            ->method('getSpySalesOrderItemGiftCards')
            ->willReturn($salesOrderItem1GiftCards);

        $spySalesOrderItem2Mock->expects(static::atLeastOnce())
            ->method('getSpySalesOrderItemGiftCards')
            ->willReturn($salesOrderItem2GiftCards);

        $spySalesOrderItemGiftCard1Mock->expects(static::atLeastOnce())
            ->method('getCode')
            ->willReturn('code1');

        $spySalesOrderItemGiftCard2Mock->expects(static::atLeastOnce())
            ->method('getCode')
            ->willReturn('code2');

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
           ->method('toArray')
           ->willReturn([]);

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $jellyfishOrderTransfer = $this->jellyfishOrderItemsSplitter
            ->splitGiftCardOrderItems($this->jellyfishOrderTransferMock, $this->spySalesOrderMock);

        $this->assertInstanceOf(JellyfishOrderTransfer::class, $jellyfishOrderTransfer);
        $this->assertEquals(2, count($jellyfishOrderTransfer->getItems()));
    }
}
