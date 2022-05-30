<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProportionalValue\Business\GiftCardProportionalValueFacadeInterface;
use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;

class JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProprotionalValueConnectorFacadeBridgeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $proportionalGiftCardValueTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Business\GiftCardProportionalValueFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardProportionalValueFacadeMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeInterface
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->giftCardProportionalValueFacadeMock = $this
            ->getMockBuilder(GiftCardProportionalValueFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->proportionalGiftCardValueTransferMock = $this
            ->getMockBuilder(ProportionalGiftCardValueTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeBridge(
            $this->giftCardProportionalValueFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testFindOrCreateProportionalGiftCardValue(): void
    {
        $this->giftCardProportionalValueFacadeMock->expects(static::atLeastOnce())
            ->method('findOrCreateProportionalGiftCardValue')
            ->willReturn($this->proportionalGiftCardValueTransferMock);

        $this->bridge->findOrCreateProportionalGiftCardValue($this->proportionalGiftCardValueTransferMock);
    }

    /**
     * @return void
     */
    public function testFindGiftCardAmountByIdSalesOrderItem(): void
    {
        $this->giftCardProportionalValueFacadeMock->expects(static::atLeastOnce())
            ->method('findGiftCardAmountByIdSalesOrderItem')
            ->willReturn(1);

        $this->bridge->findGiftCardAmountByIdSalesOrderItem(1);
    }
}
