<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorRepositoryInterface;
use Generated\Shared\Transfer\ItemTransfer;

class GiftCardAmountReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Reader\GiftCardAmountReaderInterface
     */
    protected $giftCardAmountReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(JellyfishSalesOrderPayoneGiftCardConnectorRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardAmountReader = new GiftCardAmountReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testGetByItemTransferWithoutIdSalesOrderItem(): void
    {
        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn(null);

        $this->repositoryMock->expects(static::never())
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

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findGiftCardAmountByIdSalesOrderItem')
            ->with($idSalesOrderItem)
            ->willReturn($giftCardAmount);

        static::assertEquals(
            $giftCardAmount,
            $this->giftCardAmountReader->getByItemTransfer($this->itemTransferMock),
        );
    }
}
