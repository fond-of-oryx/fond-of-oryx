<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Dependency\Facade\JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeInterface;
use Generated\Shared\Transfer\JellyfishOrderGiftCardTransfer;
use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
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
     * @var \Generated\Shared\Transfer\JellyfishOrderItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderItemTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Dependency\Facade\JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeInterface|\PHPUnit\Framework\MockObject\MockObjec
     */
    protected $productCardCodeTypeRestrictionFacadeMock;

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

        $this->jellyfishOrderItemTransferMock = $this->getMockBuilder(JellyfishOrderItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCardCodeTypeRestrictionFacadeMock = $this
            ->getMockBuilder(JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->expander = new JellyfishOrderExpander(
            $this->jellyfishOrderGiftCardMapperMock,
            $this->productCardCodeTypeRestrictionFacadeMock,
        );
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

        $jellyfishOrderTransfer = $this->expander->expand(
            $this->jellyfishOrderTransferMock,
            $this->spySalesOrderMock,
        );

        $this->assertInstanceOf(JellyfishOrderTransfer::class, $this->jellyfishOrderTransferMock);

        $this->assertEquals($jellyfishOrderTransfer, $this->jellyfishOrderTransferMock);
    }

    /**
     * @return void
     */
    public function testExpandOrderItemsWithGiftCardRestrictionFlag(): void
    {
        $giftCards = new ArrayObject();
        $giftCards->append($this->jellyfishOrderGiftCardTransferMock);
        $items = new ArrayObject();
        $items->append($this->jellyfishOrderItemTransferMock);
        $sku = 'sku';
        $blacklistedItems = [
            'sku' => ['0' => 'gift card'],
        ];

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('getGiftCards')
            ->willReturn($giftCards);

        $this->productCardCodeTypeRestrictionFacadeMock->expects(static::atLeastOnce())
            ->method('getBlacklistedCartCodeTypesByProductConcreteSkus')
            ->willReturn($blacklistedItems);

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn($items);

        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($sku);

        $jellyfishOrderTransfer = $this->expander->expandOrderItemsWithGiftCardRestrictionFlag(
            $this->jellyfishOrderTransferMock,
        );

        $this->assertInstanceOf(JellyfishOrderTransfer::class, $this->jellyfishOrderTransferMock);

        $this->assertEquals($jellyfishOrderTransfer, $this->jellyfishOrderTransferMock);
    }
}
