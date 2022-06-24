<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Dependency\Facade\JellyfishSalesOrderGiftCardProportionalValueConnectorToGiftCardProportionalValueFacadeInterface;
use Generated\Shared\Transfer\ItemTransfer;

class GiftCardProportionalValueReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Dependency\Facade\JellyfishSalesOrderGiftCardProportionalValueConnectorToGiftCardProportionalValueFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $proportionalValueConnectorFacade;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Reader\GiftCardProportionalValueReader
     */
    protected $giftCardAmountReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->proportionalValueConnectorFacade = $this->getMockBuilder(JellyfishSalesOrderGiftCardProportionalValueConnectorToGiftCardProportionalValueFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardAmountReader = new GiftCardProportionalValueReader($this->proportionalValueConnectorFacade);
    }

    /**
     * @return void
     */
    public function testGetByItemTransferWithoutIdSalesOrderItem(): void
    {
        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn(null);

        $this->proportionalValueConnectorFacade->expects(static::never())
            ->method('findGiftCardAmountByIdSalesOrderItem');

        static::assertEquals(
            null,
            $this->giftCardAmountReader->getByItemTransfer($this->itemTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetByItemTransfer(): void
    {
        $idSalesOrderItem = 1;
        $giftCardAmount = 100;

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn($idSalesOrderItem);

        $this->proportionalValueConnectorFacade->expects(static::atLeastOnce())
            ->method('findGiftCardAmountByIdSalesOrderItem')
            ->with($idSalesOrderItem)
            ->willReturn($giftCardAmount);

        static::assertEquals(
            $giftCardAmount,
            $this->giftCardAmountReader->getByItemTransfer($this->itemTransferMock),
        );
    }
}
