<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Sales\Business\SalesFacadeInterface;

class JellyfishGiftCardToSalesFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Sales\Business\SalesFacadeInterface
     */
    protected $salesFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\OrderTransfer
     */
    protected $orderTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToSalesFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->salesFacadeMock = $this->getMockBuilder(SalesFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new JellyfishGiftCardToSalesFacadeBridge($this->salesFacadeMock);
    }

    /**
     * @return void
     */
    public function testFindOrderByIdSalesOrderItem(): void
    {
        $idSalesOrderItem = 1;

        $this->salesFacadeMock->expects(static::atLeastOnce())
            ->method('findOrderByIdSalesOrderItem')
            ->with($idSalesOrderItem)
            ->willReturn($this->orderTransferMock);

        static::assertEquals(
            $this->orderTransferMock,
            $this->bridge->findOrderByIdSalesOrderItem($idSalesOrderItem)
        );
    }
}
