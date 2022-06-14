<?php

namespace FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Calculator;

use ArrayObject;
use Codeception\Test\Unit;
use Orm\Zed\Sales\Persistence\SpySalesExpense;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class ProportionalGiftCardCalculatorTest extends Unit
{
    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItem|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderItemMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesExpense|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesExpenseMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Calculator\ProportionalGiftCardCalculatorInterface
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

        $this->spySalesOrderItemMock =
            $this->getMockBuilder(SpySalesOrderItem::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->spySalesExpenseMock =
            $this->getMockBuilder(SpySalesExpense::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->calculator = new ProportionalGiftCardCalculator();
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

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn([$this->spySalesOrderItemMock]);

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getExpenses')
            ->willReturn([]);

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getIdSalesOrder')
            ->willReturn($orderId);

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getOrderReference')
            ->willReturn($orderRef);

        $this->spySalesOrderItemMock->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn($itemId);

        $this->spySalesOrderItemMock->expects(static::atLeastOnce())
            ->method('getPriceToPayAggregation')
            ->willReturn($itemPriceToPay);

        $this->spySalesOrderItemMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($sku);

        $this->assertCount(1, $this->calculator->calculate($this->spySalesOrderMock, new ArrayObject()));
    }

    /**
     * @return void
     */
    public function testCalculateItemsSameId(): void
    {
        $itemPriceToPay = 1000;
        $itemId = 100;
        $orderId = 99;
        $orderRef = 'ref';
        $sku = 'sku';

        $this->spySalesOrderItemMock->expects(static::exactly(2))
            ->method('getIdSalesOrderItem')
            ->willReturn($itemId);

        $itemClone = clone $this->spySalesOrderItemMock;

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn([$this->spySalesOrderItemMock, $itemClone]);

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getExpenses')
            ->willReturn([]);

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getIdSalesOrder')
            ->willReturn($orderId);

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getOrderReference')
            ->willReturn($orderRef);

        $this->spySalesOrderItemMock->expects(static::atLeastOnce())
            ->method('getPriceToPayAggregation')
            ->willReturn($itemPriceToPay);

        $this->spySalesOrderItemMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($sku);

        $this->assertCount(1, $this->calculator->calculate($this->spySalesOrderMock, new ArrayObject()));
    }

    /**
     * @return void
     */
    public function testCalculateExpenses(): void
    {
        $itemPriceToPay = 1000;
        $expenseId = 100;
        $orderId = 99;
        $orderRef = 'ref';
        $type = 'SHIPMENT_EXPENSE_TYPE';

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn([]);

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getExpenses')
            ->willReturn([$this->spySalesExpenseMock]);

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getIdSalesOrder')
            ->willReturn($orderId);

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getOrderReference')
            ->willReturn($orderRef);

        $this->spySalesExpenseMock->expects(static::atLeastOnce())
            ->method('getIdSalesExpense')
            ->willReturn($expenseId);

        $this->spySalesExpenseMock->expects(static::atLeastOnce())
            ->method('getPriceToPayAggregation')
            ->willReturn($itemPriceToPay);

        $this->spySalesExpenseMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn($type);

        $expenses = $this->calculator->calculate($this->spySalesOrderMock, new ArrayObject());

        $this->assertCount(1, $expenses);
        /** @var \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer $expense */
        foreach ($expenses as $expense) {
            $this->assertSame($expense->getSku(), 'freight');
        }
    }

    /**
     * @return void
     */
    public function testCalculateExpensesNotMatch(): void
    {
        $expenseId = 100;
        $type = 'type';

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn([]);

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getExpenses')
            ->willReturn([$this->spySalesExpenseMock]);

        $this->spySalesExpenseMock->expects(static::atLeastOnce())
            ->method('getIdSalesExpense')
            ->willReturn($expenseId);

        $this->spySalesExpenseMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn($type);

        $this->assertCount(0, $this->calculator->calculate($this->spySalesOrderMock, new ArrayObject()));
    }
}
