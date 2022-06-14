<?php

namespace FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Calculator;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Facade\GiftCardProportionalValuePayoneConnectorToSalesFacadeInterface;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Service\GiftCardProportionalValuePayoneConnectorToPayoneServiceInterface;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesExpense;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class ProportionalGiftCardCalculatorTest extends Unit
{
    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTransfer;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Facade\GiftCardProportionalValuePayoneConnectorToSalesFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesFacadeMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Service\GiftCardProportionalValuePayoneConnectorToPayoneServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $payoneServiceMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransferMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesExpense|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesExpenseMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Calculator\ProportionalGiftCardCalculatorInterface
     */
    protected $calculator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->spySalesOrderMock =
            $this->getMockBuilder(SpySalesOrder::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->orderTransfer =
            $this->getMockBuilder(OrderTransfer::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->salesFacadeMock =
            $this->getMockBuilder(GiftCardProportionalValuePayoneConnectorToSalesFacadeInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->payoneServiceMock =
            $this->getMockBuilder(GiftCardProportionalValuePayoneConnectorToPayoneServiceInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->itemTransferMock =
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->spySalesExpenseMock =
            $this->getMockBuilder(SpySalesExpense::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->calculator = new ProportionalGiftCardCalculator($this->payoneServiceMock, $this->salesFacadeMock);
    }

    /**
     * @return void
     */
    public function testCalculateItems(): void
    {
        $itemPriceToPay = 1000;
        $itemId = 100;
        $orderId = 99;
        $orderRef = 'ref';
        $sku = 'sku';

        $this->salesFacadeMock->expects(static::atLeastOnce())
            ->method('getOrderByIdSalesOrder')
            ->willReturn($this->orderTransfer);

        $this->payoneServiceMock->expects(static::atLeastOnce())
            ->method('distributeOrderPrice')
            ->willReturn($this->orderTransfer);

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getIdSalesOrder')
            ->willReturn($orderId);

        $this->orderTransfer->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn([$this->itemTransferMock]);

        $this->orderTransfer->expects(static::atLeastOnce())
            ->method('getExpenses')
            ->willReturn([]);

        $this->orderTransfer->expects(static::atLeastOnce())
            ->method('getOrderReference')
            ->willReturn($orderRef);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn($itemId);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getUnitPriceToPayAggregation')
            ->willReturn($itemPriceToPay);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($sku);

        $this->assertCount(1, $this->calculator->calculate($this->spySalesOrderMock, new ArrayObject()));
    }
}
