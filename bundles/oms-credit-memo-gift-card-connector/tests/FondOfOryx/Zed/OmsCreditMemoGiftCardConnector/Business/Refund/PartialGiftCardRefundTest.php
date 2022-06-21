<?php

namespace FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Business\Refund;

use Closure;
use Codeception\Test\Unit;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoItem;
use Orm\Zed\CreditMemo\Persistence\Map\FooCreditMemoTableMap;
use Orm\Zed\GiftCardBalance\Persistence\SpyGiftCardBalanceLog;
use Orm\Zed\GiftCardProportionalValue\Persistence\FooProportionalGiftCardValue;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class PartialGiftCardRefundTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $transactionHandlerMock;

    /**
     * @var \Propel\Runtime\ActiveRecord\ActiveRecordInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $activeRecordWithoutSaveMock;

    /**
     * @var \Propel\Runtime\ActiveRecord\ActiveRecordInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $activeRecordWithSaveMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \Orm\Zed\CreditMemo\Persistence\FooCreditMemo|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $fooCreditMemoMock;

    /**
     * @var \Orm\Zed\CreditMemo\Persistence\FooCreditMemoItem|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $fooCreditMemoItemMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItem|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderItemMock;

    /**
     * @var \Orm\Zed\GiftCardBalance\Persistence\SpyGiftCardBalanceLog|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardBalanceLogMock;

    /**
     * @var \Orm\Zed\GiftCardProportionalValue\Persistence\FooProportionalGiftCardValue|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $fooProportionalGiftCardValueMock;

    /**
     * @var \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $readOnlyArrayObjectMock;

    /**
     * @var \FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Business\Refund\PartialGiftCardRefundInterface
     */
    protected $refund;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderItemMock = $this->getMockBuilder(SpySalesOrderItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->fooCreditMemoMock = $this->getMockBuilder(FooCreditMemo::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->fooCreditMemoItemMock = $this->getMockBuilder(FooCreditMemoItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardBalanceLogMock = $this->getMockBuilder(SpyGiftCardBalanceLog::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->fooProportionalGiftCardValueMock = $this->getMockBuilder(FooProportionalGiftCardValue::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->readOnlyArrayObjectMock = $this->getMockBuilder(ReadOnlyArrayObject::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->activeRecordWithoutSaveMock = $this->getMockBuilder(ActiveRecordInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->activeRecordWithSaveMock = new class implements ActiveRecordInterface {
            /**
             * @return \Propel\Runtime\ActiveRecord\ActiveRecordInterface
             */
            public function save(): ActiveRecordInterface
            {
                return $this;
            }
        };

        $this->refund = new PartialGiftCardRefund(
            $this->transactionHandlerMock,
        );
    }

    /**
     * @return void
     */
    public function testExecutePartialRefundNoBalancesAvailable(): void
    {
        $this->spySalesOrderMock->expects(static::once())
            ->method('getSpyGiftCardBalanceLogs')
            ->willReturn([]);

        $this->spySalesOrderMock->expects(static::never())
            ->method('getFooCreditMemos');

        $this->spyGiftCardBalanceLogMock->expects(static::never())
            ->method('save');

        $this->fooProportionalGiftCardValueMock->expects(static::never())
            ->method('save');

        $this->spySalesOrderItemMock->expects(static::never())
            ->method('getIdSalesOrderItem');

        $this->transactionHandlerMock->expects(static::once())
            ->method('handleTransaction')->willReturn(true);

        $this->refund->executePartialRefund([$this->spySalesOrderItemMock], $this->spySalesOrderMock, $this->readOnlyArrayObjectMock);
    }

    /**
     * @return void
     */
    public function testExecutePartialRefundWithBalances(): void
    {
        $balance = 2000;
        $idSalesOrderItem = 99;
        $idSalesOrder = 55;
        $idGiftCardBalanceLog = 22;
        $proportionalCouponAmount = 10;

        $this->spySalesOrderMock->expects(static::once())
            ->method('getSpyGiftCardBalanceLogs')
            ->willReturn([$this->spyGiftCardBalanceLogMock]);

        $this->spyGiftCardBalanceLogMock->expects(static::once())
            ->method('getValue')
            ->willReturn($balance);

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getFooCreditMemos')->willReturn([$this->fooCreditMemoMock]);

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getFooProportionalGiftCardValues')->willReturn([$this->fooProportionalGiftCardValueMock]);

        $this->fooCreditMemoMock->expects(static::once())
            ->method('getFooCreditMemoItems')->willReturn([$this->fooCreditMemoItemMock]);

        $this->fooCreditMemoMock->expects(static::once())
            ->method('getFkSalesOrder')->willReturn($idSalesOrder);

        $this->fooCreditMemoMock->expects(static::once())
            ->method('getIdCreditMemo')->willReturn(1);

        $this->fooCreditMemoMock->expects(static::atLeastOnce())
            ->method('getState')->willReturn(FooCreditMemoTableMap::COL_STATE_IN_PROGRESS);

        $this->fooCreditMemoMock->expects(static::atLeastOnce())
            ->method('setState')->willReturnSelf();

        $this->fooCreditMemoItemMock->expects(static::atLeastOnce())
            ->method('getFkSalesOrderItem')->willReturn($idSalesOrderItem);

        $this->fooCreditMemoItemMock->expects(static::once())
            ->method('getCouponAmount')->willReturn($proportionalCouponAmount);

        $this->fooProportionalGiftCardValueMock->expects(static::once())
            ->method('getValue')->willReturn($proportionalCouponAmount);

        $this->fooProportionalGiftCardValueMock->expects(static::once())
            ->method('getFkSalesOrder')->willReturn($idSalesOrder);

        $this->fooProportionalGiftCardValueMock->expects(static::once())
            ->method('setIsRefund')->with(true)->willReturnSelf();

        $this->spyGiftCardBalanceLogMock->expects(static::once())
            ->method('getFkSalesOrder')->willReturn($idSalesOrder);

        $this->spyGiftCardBalanceLogMock->expects(static::once())
            ->method('getIdGiftCardBalanceLog')->willReturn($idGiftCardBalanceLog);

        $this->spyGiftCardBalanceLogMock->expects(static::once())
            ->method('setValue')->with($balance - $proportionalCouponAmount)->willReturnSelf();

        $this->spyGiftCardBalanceLogMock->expects(static::once())
            ->method('save')->willReturnSelf();

        $this->fooProportionalGiftCardValueMock->expects(static::once())
            ->method('save')->willReturnSelf();

        $this->fooCreditMemoMock->expects(static::once())
            ->method('save')->willReturnSelf();

        $this->spySalesOrderItemMock->expects(static::once())
            ->method('getIdSalesOrderItem')->willReturn($idSalesOrderItem);

        $self = $this;
        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')->willReturnCallback(static function (Closure $closure) use ($self) {
                $result = call_user_func($closure);
                $self->assertTrue($result);

                return $result;
            });

        $this->refund->executePartialRefund([$this->spySalesOrderItemMock], $this->spySalesOrderMock, $this->readOnlyArrayObjectMock);
    }
}
