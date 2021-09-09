<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapperInterface;
use Generated\Shared\Transfer\JellyfishOrderGiftCardTransfer;
use Generated\Shared\Transfer\JellyfishOrderTotalsTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Payment\Persistence\SpySalesPayment;
use Orm\Zed\Payment\Persistence\SpySalesPaymentMethodType;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class JellyfishOrderExpanderTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderExpanderInterface
     */
    protected $expander;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderGiftCardMapperMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderGiftCardTransferMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderTotalTransferMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \Orm\Zed\Payment\Persistence\SpySalesPayment|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesPaymentMock;

    /**
     * @var \Orm\Zed\Payment\Persistence\SpySalesPaymentMethodType|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesPaymentMethodTypeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->jellyfishOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesPaymentMock = $this->getMockBuilder(SpySalesPayment::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesPaymentMethodTypeMock = $this->getMockBuilder(SpySalesPaymentMethodType::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderGiftCardMapperMock = $this->getMockBuilder(JellyfishOrderGiftCardMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderGiftCardTransferMock = $this->getMockBuilder(JellyfishOrderGiftCardTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderTotalTransferMock = $this->getMockBuilder(JellyfishOrderTotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->expander = new JellyfishOrderExpander($this->jellyfishOrderGiftCardMapperMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $salesPayments = new ArrayObject();
        $salesPayments->append($this->spySalesPaymentMock);
        $data = [
            'paymentMethod' => 'GiftCard',
            'grandTotal' => 5000,
            'discountTotal' => 0,
            'paymentAmount' => 2000,
        ];

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getOrdersJoinSalesPaymentMethodType')
            ->willReturn($salesPayments);

        $this->spySalesPaymentMock->expects(static::atLeastOnce())
            ->method('getSalesPaymentMethodType')
            ->willReturn($this->spySalesPaymentMethodTypeMock);

        $this->spySalesPaymentMethodTypeMock->expects($this->atLeastOnce())
            ->method('getPaymentMethod')
            ->willReturn($data['paymentMethod']);

        $this->jellyfishOrderGiftCardMapperMock->expects(static::atLeastOnce())
            ->method('fromSalesPayment')
            ->willReturn($this->jellyfishOrderGiftCardTransferMock);

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('setGiftCards')
            ->willReturnSelf();

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->jellyfishOrderTotalTransferMock);

        $this->jellyfishOrderTotalTransferMock->expects(static::atLeastOnce())
            ->method('getGrandTotal')
            ->willReturn($data['grandTotal']);

        $this->jellyfishOrderTotalTransferMock->expects(static::atLeastOnce())
            ->method('getDiscountTotal')
            ->willReturn($data['discountTotal']);

        $this->spySalesPaymentMock->expects(static::atLeastOnce())
            ->method('getAmount')
            ->willReturn($data['paymentAmount']);

        $this->jellyfishOrderTotalTransferMock->expects(static::atLeastOnce())
            ->method('setDiscountTotal')
            ->willReturnSelf();

        $this->jellyfishOrderTotalTransferMock->expects(static::atLeastOnce())
            ->method('setGrandTotal')
            ->willReturnSelf();

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('setTotals')
            ->willReturnSelf();

        $jellyfishOrderTransfer = $this->expander->expand(
            $this->jellyfishOrderTransferMock,
            $this->spySalesOrderMock
        );

        $this->assertInstanceOf(JellyfishOrderTransfer::class, $this->jellyfishOrderTransferMock);

        $this->assertEquals($jellyfishOrderTransfer, $this->jellyfishOrderTransferMock);
    }
}
