<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapperInterface;
use Generated\Shared\Transfer\JellyfishOrderGiftCardTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Payment\Persistence\SpySalesPayment;
use Orm\Zed\Payment\Persistence\SpySalesPaymentMethodType;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Propel\Runtime\Collection\ObjectCollection;

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

        $this->expander = new JellyfishOrderExpander($this->jellyfishOrderGiftCardMapperMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getOrdersJoinSalesPaymentMethodType')
            ->willReturn(new ObjectCollection([$this->spySalesPaymentMock]));

        $this->spySalesPaymentMock->expects(static::atLeastOnce())
            ->method('getSalesPaymentMethodType')
            ->willReturn($this->spySalesPaymentMethodTypeMock);

        $this->spySalesPaymentMethodTypeMock->expects($this->atLeastOnce())
            ->method('getPaymentMethod')
            ->willReturn('GiftCard');

        $this->jellyfishOrderGiftCardMapperMock->expects(static::atLeastOnce())
            ->method('fromSalesPayment')
            ->willReturn($this->jellyfishOrderGiftCardTransferMock);

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('setGiftCards')
            ->willReturnSelf();

        $jellyfishOrderTransfer = $this->expander->expand(
            $this->jellyfishOrderTransferMock,
            $this->spySalesOrderMock
        );

        $this->assertInstanceOf(JellyfishOrderTransfer::class, $this->jellyfishOrderTransferMock);

        $this->assertEquals($jellyfishOrderTransfer, $this->jellyfishOrderTransferMock);
    }
}
