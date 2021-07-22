<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\GiftCardTransfer;
use Spryker\Zed\GiftCard\Business\GiftCardFacadeInterface;

class JellyfishGiftCardToGiftCardFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\GiftCard\Business\GiftCardFacadeInterface
     */
    protected $giftCardFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\GiftCardTransfer
     */
    protected $giftCardTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToGiftCardFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->giftCardFacadeMock = $this->getMockBuilder(GiftCardFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardTransferMock = $this->getMockBuilder(GiftCardTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new JellyfishGiftCardToGiftCardFacadeBridge($this->giftCardFacadeMock);
    }

    /**
     * @return void
     */
    public function testFindGiftCardByIdSalesOrderItem(): void
    {
        $idSalesOrderItem = 1;

        $this->giftCardFacadeMock->expects(static::atLeastOnce())
            ->method('findGiftCardByIdSalesOrderItem')
            ->with($idSalesOrderItem)
            ->willReturn($this->giftCardTransferMock);

        static::assertEquals(
            $this->giftCardTransferMock,
            $this->bridge->findGiftCardByIdSalesOrderItem($idSalesOrderItem)
        );
    }
}
