<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Reader\GiftCardAmountReaderInterface;
use Generated\Shared\Transfer\ItemTransfer;

class OrderItemsExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Reader\GiftCardAmountReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardAmountReaderMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Expander\OrderItemsExpander
     */
    protected $orderItemsExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->giftCardAmountReaderMock = $this->getMockBuilder(GiftCardAmountReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderItemsExpander = new OrderItemsExpander($this->giftCardAmountReaderMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $giftCardAmount = 100;
        $itemTransferMocks = [$this->itemTransferMock];

        $this->giftCardAmountReaderMock->expects(static::atLeastOnce())
            ->method('getByItemTransfer')
            ->with($this->itemTransferMock)
            ->willReturn($giftCardAmount);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('setGiftCardAmount')
            ->with($giftCardAmount)
            ->willReturn($this->itemTransferMock);

        static::assertEquals(
            $itemTransferMocks,
            $this->orderItemsExpander->expand($itemTransferMocks),
        );
    }
}
