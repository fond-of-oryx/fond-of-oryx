<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemGiftCard;
use Propel\Runtime\Collection\ObjectCollection;

class JellyfishOrderItemExpanderTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderItemTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderItemExpanderInterface
     */
    protected $expander;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItem|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesOrderItemMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItemGiftCard|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesOrderItemGiftCardMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Propel\Runtime\Collection\ObjectCollection
     */
    protected $salesOrderItemGiftCardCollectionMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->jellyfishOrderItemTransferMock = $this->getMockBuilder(JellyfishOrderItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderItemMock = $this->getMockBuilder(SpySalesOrderItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderItemGiftCardMock = $this->getMockBuilder(SpySalesOrderItemGiftCard::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderItemGiftCardCollectionMock = $this->getMockBuilder(ObjectCollection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->expander = new JellyfishOrderItemExpander();
    }

    /**
     * @return void
     */
    public function testExpandWithTypeGiftCard(): void
    {
        $giftCardCode = 'xxx-xxx-xxx';

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('getProductType')
            ->willReturn('gift_card');

        $this->salesOrderItemMock->expects(static::atLeastOnce())
            ->method('getSpySalesOrderItemGiftCards')
            ->willReturn($this->salesOrderItemGiftCardCollectionMock);

        $this->salesOrderItemGiftCardCollectionMock->expects(static::atLeastOnce())
            ->method('count')
            ->willReturn(1);

        $this->salesOrderItemGiftCardCollectionMock->expects(static::atLeastOnce())
            ->method('getFirst')
            ->willReturn($this->salesOrderItemGiftCardMock);

        $this->salesOrderItemGiftCardMock->expects(static::atLeastOnce())
            ->method('getCode')
            ->willReturn($giftCardCode);

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('setGiftCardCode')
            ->with($giftCardCode)
            ->willReturnSelf();

        $jellyfishOrderItemTransfer = $this->expander->expand(
            $this->jellyfishOrderItemTransferMock,
            $this->salesOrderItemMock,
        );

        static::assertInstanceOf(JellyfishOrderItemTransfer::class, $this->jellyfishOrderItemTransferMock);

        static::assertEquals($jellyfishOrderItemTransfer, $this->jellyfishOrderItemTransferMock);
    }
}
