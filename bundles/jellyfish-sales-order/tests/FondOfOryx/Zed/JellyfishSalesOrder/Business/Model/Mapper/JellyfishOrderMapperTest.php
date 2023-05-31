<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Communication\Plugin;

use Codeception\Test\Unit;
use DateTime;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderAddressMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderExpenseMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderMapper;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderPaymentMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderTotalsMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderConfig;
use Generated\Shared\Transfer\JellyfishOrderAddressTransfer;
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
    protected $configMock;

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
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderExpenseMapperInterface
     */
    protected $jellyfishOrderExpenseMapperMock;

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
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderTotalsMapperInterface
     */
    protected $jellyfishOrderTotalsMapperMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->configMock = $this->getMockBuilder(JellyfishSalesOrderConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

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

        $this->jellyfishOrderExpenseMapperMock = $this->getMockBuilder(JellyfishOrderExpenseMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderPaymentMapperMock = $this->getMockBuilder(JellyfishOrderPaymentMapperInterface::class)
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
            $this->jellyfishOrderPaymentMapperMock,
            $this->jellyfishOrderTotalsMapperMock,
            $this->configMock,
            [],
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
            'locale' => [
                'locale_name' => 'en_US',
            ],
            'created_at' => new DateTime(),
        ];

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn($data);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getIdSalesOrder')
            ->willReturn($data['id_sales_order']);

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getOrderReference')
            ->willReturn($data['order_reference']);

        $this->configMock->expects($this->atLeastOnce())
            ->method('getSystemCode')
            ->willReturn('default');

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

        $this->spyLocaleMock->expects($this->atLeastOnce())
            ->method('getLocaleName')
            ->willReturn($data['locale']['locale_name']);

        $jellyfishOrderTransfer = $this->jellyfishOrderMapper->fromSalesOrder($this->spySalesOrderMock);

        static::assertEquals($data['id_sales_order'], $jellyfishOrderTransfer->getId());
        static::assertEquals($data['order_reference'], $jellyfishOrderTransfer->getReference());
        static::assertEquals($data['customer_reference'], $jellyfishOrderTransfer->getCustomerReference());
        static::assertEquals($data['email'], $jellyfishOrderTransfer->getEmail());
        static::assertEquals($data['locale']['locale_name'], $jellyfishOrderTransfer->getLocale());
        static::assertEquals($data['store'], $jellyfishOrderTransfer->getStore());
        static::assertEquals('default', $jellyfishOrderTransfer->getSystemCode());
    }
}
