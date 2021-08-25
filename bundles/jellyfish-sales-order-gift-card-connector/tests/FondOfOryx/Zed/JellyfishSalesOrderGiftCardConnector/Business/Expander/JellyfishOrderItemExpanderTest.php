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
    protected $spySalesOrderItemMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItemGiftCard|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderItemGiftCardMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->jellyfishOrderItemTransferMock = $this->getMockBuilder(JellyfishOrderItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderItemMock = $this->getMockBuilder(SpySalesOrderItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderItemGiftCardMock = $this->getMockBuilder(SpySalesOrderItemGiftCard::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->expander = new JellyfishOrderItemExpander();
    }

    /**
     * @return void
     */
    public function testExpandWithTypeGiftCard(): void
    {
        $giftCards = new ObjectCollection(
            [$this->spySalesOrderItemGiftCardMock]
        );
        $giftCardCode = 'xxx-xxx-xxx';

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('getProductType')
            ->willReturn('gift_card');

        $this->spySalesOrderItemMock->expects(static::atLeastOnce())
            ->method('getSpySalesOrderItemGiftCards')
            ->willReturn($giftCards);

        $this->spySalesOrderItemGiftCardMock->expects(static::atLeastOnce())
            ->method('getCode')
            ->willReturn($giftCardCode);

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('setGiftCardCode')
            ->with($giftCardCode)
            ->willReturnSelf();

        $jellyfishOrderItemTransfer = $this->expander->expand(
            $this->jellyfishOrderItemTransferMock,
            $this->spySalesOrderItemMock
        );

        $this->assertInstanceOf(JellyfishOrderItemTransfer::class, $this->jellyfishOrderItemTransferMock);

        $this->assertEquals($jellyfishOrderItemTransfer, $this->jellyfishOrderItemTransferMock);
    }
}
