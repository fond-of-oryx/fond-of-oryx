<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Shared\JellyfishSalesOrderGiftCardProportionalValueConnector\JellyfishSalesOrderGiftCardProportionalValueConnectorConstants;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\JellyfishSalesOrderGiftCardProportionalValueConnectorConfig;
use Generated\Shared\Transfer\JellyfishOrderExpenseTransfer;
use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Generated\Shared\Transfer\JellyfishProportionalCouponValueTransfer;
use Orm\Zed\GiftCardProportionalValue\Persistence\FooProportionalGiftCardValue;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class GiftCardProportionalValueMapperTest extends Unit
{
    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \Orm\Zed\GiftCardProportionalValue\Persistence\FooProportionalGiftCardValue|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $fooProportionalGiftCardValueMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderItemTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $jellyfishOrderItemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderExpenseTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $jellyfishOrderExpenseTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\JellyfishSalesOrderGiftCardProportionalValueConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Mapper\ProportionalValueMapperInterface
     */
    protected $mapper;

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

        $this->jellyfishOrderTransferMock =
            $this->getMockBuilder(JellyfishOrderTransfer::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->jellyfishOrderItemTransferMock =
            $this->getMockBuilder(JellyfishOrderItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->jellyfishOrderExpenseTransferMock =
            $this->getMockBuilder(JellyfishOrderExpenseTransfer::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->fooProportionalGiftCardValueMock =
            $this->getMockBuilder(FooProportionalGiftCardValue::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->configMock =
            $this->getMockBuilder(JellyfishSalesOrderGiftCardProportionalValueConnectorConfig::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->mapper = new GiftCardProportionalValueMapper($this->configMock);
    }

    /**
     * @return void
     */
    public function testFromSalesOrderToJellyfishOrder(): void
    {
        $self = $this;
        $idSalesOrder = 1;
        $idSalesOrderItem = 2;
        $idSalesExpense = 3;
        $orderRef = 'ref';
        $sku = 'sku';
        $value = 1000;

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getFooProportionalGiftCardValues')
            ->willReturn([$this->fooProportionalGiftCardValueMock]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getExpenseMapping')
            ->willReturn(JellyfishSalesOrderGiftCardProportionalValueConnectorConstants::DEFAULT_EXPENSE_MAPPING);

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('getExpenses')
            ->willReturn([$this->jellyfishOrderExpenseTransferMock]);

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn([$this->jellyfishOrderItemTransferMock]);

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('setGiftCardBalances')
            ->willReturnCallback(static function (ArrayObject $proportionalGiftCardValueTransfers) use ($self, $idSalesOrder, $idSalesOrderItem, $idSalesExpense, $sku, $orderRef, $value) {
                $self->assertCount(1, $proportionalGiftCardValueTransfers);

                /** @var \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer */
                $proportionalGiftCardValueTransfer = $proportionalGiftCardValueTransfers->offsetGet(0);

                $self->assertSame($idSalesOrder, $proportionalGiftCardValueTransfer->getFkSalesOrder());
                $self->assertSame($idSalesOrderItem, $proportionalGiftCardValueTransfer->getFkSalesOrderItem());
                $self->assertSame($idSalesExpense, $proportionalGiftCardValueTransfer->getFkSalesExpense());
                $self->assertSame($orderRef, $proportionalGiftCardValueTransfer->getOrderReference());
                $self->assertSame($sku, $proportionalGiftCardValueTransfer->getSku());
                $self->assertSame($value, $proportionalGiftCardValueTransfer->getValue());

                return $self->jellyfishOrderTransferMock;
            });

        $this->fooProportionalGiftCardValueMock->expects(static::atLeastOnce())
            ->method('getFkSalesOrderItem')
            ->willReturn($idSalesOrderItem);

        $this->fooProportionalGiftCardValueMock->expects(static::atLeastOnce())
            ->method('getFkSalesOrder')
            ->willReturn($idSalesOrder);

        $this->fooProportionalGiftCardValueMock->expects(static::atLeastOnce())
            ->method('getFkSalesExpense')
            ->willReturn($idSalesExpense);

        $this->fooProportionalGiftCardValueMock->expects(static::atLeastOnce())
            ->method('getOrderReference')
            ->willReturn($orderRef);

        $this->fooProportionalGiftCardValueMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($sku);

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($sku);

        $this->jellyfishOrderExpenseTransferMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(array_key_first(JellyfishSalesOrderGiftCardProportionalValueConnectorConstants::DEFAULT_EXPENSE_MAPPING));

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('addProportionalCouponValue')
            ->willReturnCallback(static function (JellyfishProportionalCouponValueTransfer $proportionalCouponValue) use ($self, $idSalesOrderItem, $value) {
                $self->assertSame($idSalesOrderItem, $proportionalCouponValue->getIdSalesOrderItem());
                $self->assertSame($value, $proportionalCouponValue->getAmount());

                return $self->jellyfishOrderItemTransferMock;
            });

        $this->fooProportionalGiftCardValueMock->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn($value);

        $this->mapper->fromSalesOrderToJellyfishOrder($this->jellyfishOrderTransferMock, $this->spySalesOrderMock);
    }
}
