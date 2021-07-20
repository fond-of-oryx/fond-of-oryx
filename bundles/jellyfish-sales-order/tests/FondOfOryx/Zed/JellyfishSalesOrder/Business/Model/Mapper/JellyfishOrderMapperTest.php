<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Communication\Plugin;

use Codeception\Test\Unit;
use DateTime;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderAddressMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderDiscountMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderExpenseMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderGiftCardMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderMapper;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderPaymentMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderTotalsMapperInterface;
use Generated\Shared\Transfer\JellyfishOrderGiftCardTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Locale\Persistence\SpyLocale;
use Orm\Zed\Payment\Persistence\SpySalesPayment;
use Orm\Zed\Payment\Persistence\SpySalesPaymentMethodType;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress;
use Propel\Runtime\Collection\ObjectCollection;

class JellyfishOrderMapperTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\JellyfishOrderAddressTransfer
     */
    protected $jellyfishOrderAddressTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderMapper
     */
    protected $jellyfishOrderMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderAddressMapperInterface
     */
    protected $jellyfishOrderAddressMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderGiftCardMapperInterface
     */
    protected $jellyfishOrderGiftCardMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\JellyfishOrderGiftCardTransfer
     */
    protected $jellyfishOrderGiftCardTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderExpenseMapperInterface
     */
    protected $jellyfishOrderExpenseMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderDiscountMapperInterface
     */
    protected $jellyfishOrderDiscountMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderPaymentMapperInterface
     */
    protected $jellyfishOrderPaymentMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderTotalsMapperInterface
     */
    protected $jellyfishOrderTotalsMapperInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Locale\Persistence\SpyLocale
     */
    protected $spyLocaleMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Payment\Persistence\SpySalesPayment
     */
    protected $spySalesPaymentMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Payment\Persistence\SpySalesPaymentMethodType
     */
    protected $spySalesPaymentMethodTypeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrder
     */
    protected $spySalesOrderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrderAddress
     */
    protected $spySalesOrderAddressMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyLocaleMock = $this->getMockBuilder(SpyLocale::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesPaymentMethodTypeMock = $this->getMockBuilder(SpySalesPaymentMethodType::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesPaymentMock = $this->getMockBuilder(SpySalesPayment::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderAddressMock = $this->getMockBuilder(SpySalesOrderAddress::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderAddressMapperMock = $this->getMockBuilder(JellyfishOrderAddressMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderGiftCardMapperMock = $this->getMockBuilder(JellyfishOrderGiftCardMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderGiftCardTransferMock = $this->getMockBuilder(JellyfishOrderGiftCardTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderExpenseMapperMock = $this->getMockBuilder(JellyfishOrderExpenseMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderDiscountMapperMock = $this->getMockBuilder(JellyfishOrderDiscountMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->JellyfishOrderPaymentMapperMock = $this->getMockBuilder(JellyfishOrderPaymentMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderTotalsMapperMock = $this->getMockBuilder(JellyfishOrderTotalsMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderAddressTransferMock = $this->getMockBuilder(JellyfishOrderAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderMapper = new JellyfishOrderMapper(
            $this->jellyfishOrderAddressMapperMock,
            $this->jellyfishOrderExpenseMapperMock,
            $this->jellyfishOrderGiftCardMapperMock,
            $this->jellyfishOrderDiscountMapperMock,
            $this->JellyfishOrderPaymentMapperMock,
            $this->jellyfishOrderTotalsMapperMock,
            [],
            'default'
        );
    }

    /**
     * @return void
     */
    public function testFromSalesOrder(): void
    {
        $data = [
            'id_sales_order' => 1,
            'order_reference' => '1000000034561',
            'customer_reference' => 'CUS--1',
            'email' => 'example@example.com',
            'price_mode' => 'gross',
            'currency_iso_code' => 'EUR',
            'store' => 'default',
            'locale' => 'en_US',
            'created_at' => new DateTime(),
        ];

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getIdSalesOrder')
            ->willReturn($data['id_sales_order']);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getOrderReference')
            ->willReturn($data['order_reference']);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($data['customer_reference']);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getEmail')
            ->willReturn($data['email']);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getPriceMode')
            ->willReturn($data['price_mode']);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getStore')
            ->willReturn($data['store']);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getCreatedAt')
            ->willReturn($data['created_at']);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn($this->spySalesOrderAddressMock);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->spySalesOrderAddressMock);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getLocale')
            ->willReturn($this->spyLocaleMock);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getOrdersJoinSalesPaymentMethodType')
            ->willReturn(new ObjectCollection());

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getExpenses')
            ->willReturn(new ObjectCollection());

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getDiscounts')
            ->willReturn(new ObjectCollection());

        $this->spyLocaleMock->expects($this->atLeastOnce())
            ->method('getLocaleName')
            ->willReturn($data['locale']);

        $jellyfishOrderTransfer = $this->jellyfishOrderMapper->fromSalesOrder($this->spySalesOrderMock);

        $this->assertInstanceOf(JellyfishOrderTransfer::class, $jellyfishOrderTransfer);
        $this->assertEquals($data['id_sales_order'], $jellyfishOrderTransfer->getId());
        $this->assertEquals($data['order_reference'], $jellyfishOrderTransfer->getReference());
        $this->assertEquals($data['customer_reference'], $jellyfishOrderTransfer->getCustomerReference());
        $this->assertEquals($data['email'], $jellyfishOrderTransfer->getEmail());
        $this->assertEquals($data['locale'], $jellyfishOrderTransfer->getLocale());
        $this->assertEquals($data['store'], $jellyfishOrderTransfer->getStore());
        $this->assertEquals('default', $jellyfishOrderTransfer->getSystemCode());
    }

    /**
     * @return void
     */
    public function testFromSalesOrderWithGiftCard(): void
    {
        $data = [
            'id_sales_order' => 1,
            'order_reference' => '1000000034561',
            'customer_reference' => 'CUS--1',
            'email' => 'example@example.com',
            'price_mode' => 'gross',
            'currency_iso_code' => 'EUR',
            'store' => 'default',
            'locale' => 'en_US',
            'created_at' => new DateTime(),
        ];

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getIdSalesOrder')
            ->willReturn($data['id_sales_order']);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getOrderReference')
            ->willReturn($data['order_reference']);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($data['customer_reference']);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getEmail')
            ->willReturn($data['email']);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getPriceMode')
            ->willReturn($data['price_mode']);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getStore')
            ->willReturn($data['store']);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getCreatedAt')
            ->willReturn($data['created_at']);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn($this->spySalesOrderAddressMock);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->spySalesOrderAddressMock);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getLocale')
            ->willReturn($this->spyLocaleMock);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getOrdersJoinSalesPaymentMethodType')
            ->willReturn(new ObjectCollection([$this->spySalesPaymentMock]));

        $this->spySalesPaymentMock->expects($this->atLeastOnce())
            ->method('getSalesPaymentMethodType')
            ->willReturn($this->spySalesPaymentMethodTypeMock);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getExpenses')
            ->willReturn(new ObjectCollection());

        $this->spySalesPaymentMethodTypeMock->expects($this->atLeastOnce())
            ->method('getPaymentMethod')
            ->willReturn('GiftCard');

        $this->jellyfishOrderGiftCardMapperMock->expects($this->atLeastOnce())
            ->method('fromSalesPayment')
            ->willReturn($this->jellyfishOrderGiftCardTransferMock);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getDiscounts')
            ->willReturn(new ObjectCollection());

        $this->spyLocaleMock->expects($this->atLeastOnce())
            ->method('getLocaleName')
            ->willReturn($data['locale']);

        $jellyfishOrderTransfer = $this->jellyfishOrderMapper->fromSalesOrder($this->spySalesOrderMock);

        $this->assertInstanceOf(JellyfishOrderTransfer::class, $jellyfishOrderTransfer);
        $this->assertEquals(1, $jellyfishOrderTransfer->getGiftCards()->count());
    }
}
