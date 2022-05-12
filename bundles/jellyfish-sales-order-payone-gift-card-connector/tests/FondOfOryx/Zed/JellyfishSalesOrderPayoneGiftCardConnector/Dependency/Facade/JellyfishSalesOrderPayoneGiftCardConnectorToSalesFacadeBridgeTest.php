<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Sales\Business\SalesFacadeInterface;

class JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeBridgeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $orderTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface
     */
    protected $salesFacadeBridge;

    /**
     * @var \Spryker\Zed\Sales\Business\SalesFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $salesFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->salesFacadeMock = $this
            ->getMockBuilder(SalesFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this
            ->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesFacadeBridge = new JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeBridge(
            $this->salesFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetOrderByIdSalesOrder(): void
    {
        $this->salesFacadeMock->expects(static::atLeastOnce())
            ->method('getOrderByIdSalesOrder')
            ->willReturn($this->orderTransferMock);

        static::assertInstanceOf(
            OrderTransfer::class,
            $this->salesFacadeBridge->getOrderByIdSalesOrder(1),
        );
    }
}
