<?php

/**
 * phpcs:disable SlevomatCodingStandard.Functions.DisallowTrailingCommaInClosureUse
 */

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Calculator;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Service\JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface;
use Generated\Shared\Transfer\ExpenseTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\JellyfishOrderExpenseTransfer;
use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Generated\Shared\Transfer\JellyfishProportionalCouponValueTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class ProportionalGiftCardAmountCalculatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Service\JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $payoneServiceMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $recalculatedOrderTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Calculator\ProportionalGiftCardAmountCalculator
     */
    protected $calculator;

    /**
     * @var array<\Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $itemTransferMocks;

    /**
     * @var array<\Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $recalculatedItemTransferMocks;

    /**
     * @var array<\Generated\Shared\Transfer\ExpenseTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $expenseTransferMocks;

    /**
     * @var array<\Generated\Shared\Transfer\ExpenseTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $recalculatedExpenseTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var array<\Generated\Shared\Transfer\JellyfishOrderItemTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $jellyfishOrderItemTransferMocks;

    /**
     * @var array<\Generated\Shared\Transfer\JellyfishOrderExpenseTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $jellyfishOrderExpenseTransferMocks;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->payoneServiceMock = $this->getMockBuilder(JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesFacadeMock = $this->getMockBuilder(JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->recalculatedOrderTransferMock = $this->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMocks = [
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->recalculatedItemTransferMocks = [
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->expenseTransferMocks = [
            $this->getMockBuilder(ExpenseTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ExpenseTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->recalculatedExpenseTransferMocks = [
            $this->getMockBuilder(ExpenseTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ExpenseTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->jellyfishOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderItemTransferMocks = [
            $this->getMockBuilder(JellyfishOrderItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(JellyfishOrderItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->jellyfishOrderExpenseTransferMocks = [
            $this->getMockBuilder(JellyfishOrderExpenseTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(JellyfishOrderExpenseTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->calculator = new ProportionalGiftCardAmountCalculator(
            $this->payoneServiceMock,
            $this->salesFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testCalculate(): void
    {
        $idSalesOrder = 1;
        $orderReference = 'ORDER-REF';
        $salesOrderItemIds = [2, 3];
        $skus = ['SKU1', 'SKU2'];
        $unitPriceToPayAggregations = [1000, 1000];
        $recalculatedUnitPriceToPayAggregations = [500, 500];
        $expenseIds = [4, 5];
        $sumGrossPrices = [100];
        $recalculatedSumGrossPrices = [50];

        $this->salesFacadeMock->expects(static::atLeastOnce())
            ->method('getOrderByIdSalesOrder')
            ->with($idSalesOrder)
            ->willReturn($this->orderTransferMock);

        $this->payoneServiceMock->expects(static::atLeastOnce())
            ->method('distributeOrderPrice')
            ->willReturn($this->recalculatedOrderTransferMock);

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->itemTransferMocks));

        $this->recalculatedOrderTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->recalculatedItemTransferMocks));

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn($salesOrderItemIds[0]);

        $this->recalculatedItemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn($salesOrderItemIds[0]);

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn($salesOrderItemIds[1]);

        $this->recalculatedItemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn($salesOrderItemIds[1]);

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getIdSalesOrder')
            ->willReturn($idSalesOrder);

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getOrderReference')
            ->willReturn($orderReference);

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getUnitPriceToPayAggregation')
            ->willReturn($unitPriceToPayAggregations[0]);

        $this->recalculatedItemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getUnitPriceToPayAggregation')
            ->willReturn($recalculatedUnitPriceToPayAggregations[0]);

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getUnitPriceToPayAggregation')
            ->willReturn($unitPriceToPayAggregations[1]);

        $this->recalculatedItemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getUnitPriceToPayAggregation')
            ->willReturn($recalculatedUnitPriceToPayAggregations[1]);

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[0]);

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[1]);

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getExpenses')
            ->willReturn(new ArrayObject($this->expenseTransferMocks));

        $this->recalculatedOrderTransferMock->expects(static::atLeastOnce())
            ->method('getExpenses')
            ->willReturn(new ArrayObject($this->recalculatedExpenseTransferMocks));

        $this->expenseTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdSalesExpense')
            ->willReturn($expenseIds[0]);

        $this->expenseTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getIdSalesExpense')
            ->willReturn($expenseIds[1]);

        $this->recalculatedExpenseTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdSalesExpense')
            ->willReturn($expenseIds[0]);

        $this->recalculatedExpenseTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getIdSalesExpense')
            ->willReturn($expenseIds[1]);

        $this->expenseTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getSumGrossPrice')
            ->willReturn($sumGrossPrices[0]);

        $this->expenseTransferMocks[1]->expects(static::never())
            ->method('getSumGrossPrice');

        $this->recalculatedExpenseTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getSumGrossPrice')
            ->willReturn($recalculatedSumGrossPrices[0]);

        $this->recalculatedExpenseTransferMocks[1]->expects(static::never())
            ->method('getSumGrossPrice');

        $this->expenseTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('SHIPMENT_EXPENSE_TYPE');

        $this->expenseTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('XYZ_EXPENSE_TYPE');

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->jellyfishOrderItemTransferMocks));

        $this->jellyfishOrderItemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[0]);

        $this->jellyfishOrderItemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('addProportionalCouponValue')
            ->with(
                static::callback(
                    static function (
                        JellyfishProportionalCouponValueTransfer $jellyfishProportionalCouponValueTransfer
                    ) use (
                        $unitPriceToPayAggregations,
                        $recalculatedUnitPriceToPayAggregations,
                        $salesOrderItemIds,
                    ) {
                        $amount = $unitPriceToPayAggregations[0] - $recalculatedUnitPriceToPayAggregations[0];

                        return $jellyfishProportionalCouponValueTransfer->getAmount() === $amount
                            && $jellyfishProportionalCouponValueTransfer->getIdSalesOrderItem() === $salesOrderItemIds[0];
                    },
                ),
            )->willReturn($this->jellyfishOrderItemTransferMocks[0]);

        $this->jellyfishOrderItemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[1]);

        $this->jellyfishOrderItemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('addProportionalCouponValue')
            ->with(
                static::callback(
                    static function (
                        JellyfishProportionalCouponValueTransfer $jellyfishProportionalCouponValueTransfer
                    ) use (
                        $unitPriceToPayAggregations,
                        $recalculatedUnitPriceToPayAggregations,
                        $salesOrderItemIds,
                    ) {
                        $amount = $unitPriceToPayAggregations[1] - $recalculatedUnitPriceToPayAggregations[1];

                        return $jellyfishProportionalCouponValueTransfer->getAmount() === $amount
                            && $jellyfishProportionalCouponValueTransfer->getIdSalesOrderItem() === $salesOrderItemIds[1];
                    },
                ),
            )->willReturn($this->jellyfishOrderItemTransferMocks[1]);

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('getExpenses')
            ->willReturn(new ArrayObject($this->jellyfishOrderExpenseTransferMocks));

        $this->jellyfishOrderExpenseTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('SHIPMENT_EXPENSE_TYPE');

        $this->jellyfishOrderExpenseTransferMocks[0]->expects(static::atLeastOnce())
            ->method('addProportionalCouponValue')
            ->with(
                static::callback(
                    static function (
                        JellyfishProportionalCouponValueTransfer $jellyfishProportionalCouponValueTransfer
                    ) use (
                        $sumGrossPrices,
                        $recalculatedSumGrossPrices,
                    ) {
                        $amount = $sumGrossPrices[0] - $recalculatedSumGrossPrices[0];

                        return $jellyfishProportionalCouponValueTransfer->getAmount() === $amount;
                    },
                ),
            )->willReturn($this->jellyfishOrderExpenseTransferMocks[0]);

        $this->jellyfishOrderExpenseTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('XYZ_EXPENSE_TYPE');

        $this->jellyfishOrderExpenseTransferMocks[1]->expects(static::never())
            ->method('addProportionalCouponValue');

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('setGiftCardBalances')
            ->with(
                static::callback(
                    static function (ArrayObject $proportionalGiftCardValueTransfers) {
                        return $proportionalGiftCardValueTransfers->count() === 3;
                    },
                ),
            )->willReturn($this->jellyfishOrderTransferMock);

        static::assertEquals(
            $this->jellyfishOrderTransferMock,
            $this->calculator->calculate($this->jellyfishOrderTransferMock, $idSalesOrder),
        );
    }
}
