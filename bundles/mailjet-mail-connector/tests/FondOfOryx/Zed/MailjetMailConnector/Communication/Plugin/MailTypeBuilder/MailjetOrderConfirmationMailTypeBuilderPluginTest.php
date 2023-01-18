<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Communication\Plugin\MailTypeBuilder;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesAddressMapper;
use FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesCalculatedDiscountsMapper;
use FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesPaymentsMapper;
use FondOfOryx\Zed\MailjetMailConnector\Communication\MailjetMailConnectorCommunicationFactory;
use FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CalculatedDiscountTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\MailjetTemplateTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use Generated\Shared\Transfer\TotalsTransfer;

class MailjetOrderConfirmationMailTypeBuilderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Communication\MailjetMailConnectorCommunicationFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailTransferMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTranserMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ShipmentTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $shipmentTransferMock;

    /**
     * @var \Generated\Shared\Transfer\TotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $totalsTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $shippingAddressTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $billingAddressTransfer;

    /**
     * @var \Generated\Shared\Transfer\PaymentTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paymentTransferMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesAddressMapper|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailjetTemplateVariablesAddressMapperMock;

    /**
     * @var \Generated\Shared\Transfer\CalculatedDiscountTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $calculatedDiscountTransferMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesCalculatedDiscountsMapper|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailjetTemplateVariablesCalculatedDiscountsMapperMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesPaymentsMapper|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailjetTemplateVariablesPaymentsMapper;

    /**
     * @var \Generated\Shared\Transfer\MailjetTemplateTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailjetTemplateTransferMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Communication\Plugin\MailTypeBuilder\OrderConfirmationMailTypeBuilderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(MailjetMailConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTranserMock = $this->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTransferMock = $this->getMockBuilder(ShipmentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->billingAddressTransfer = $this->getMockBuilder(AddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shippingAddressTransferMock = $this->getMockBuilder(AddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailjetTemplateVariablesAddressMapperMock = $this->getMockBuilder(MailjetTemplateVariablesAddressMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->totalsTransferMock = $this->getMockBuilder(TotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(MailjetMailConnectorCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentTransferMock = $this->getMockBuilder(PaymentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->calculatedDiscountTransferMock = $this->getMockBuilder(CalculatedDiscountTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailjetTemplateVariablesCalculatedDiscountsMapperMock = $this->getMockBuilder(MailjetTemplateVariablesCalculatedDiscountsMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailjetTemplateVariablesPaymentsMapper = $this->getMockBuilder(MailjetTemplateVariablesPaymentsMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailjetTemplateTransferMock = $this->getMockBuilder(MailjetTemplateTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new OrderConfirmationMailTypeBuilderPlugin();
        $this->plugin->setConfig($this->configMock);
        $this->plugin->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testBuild(): void
    {
        $this->orderTranserMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn($this->billingAddressTransfer);

        $this->orderTranserMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject([$this->itemTransferMock]));

        $this->orderTranserMock->expects(static::atLeastOnce())
            ->method('getCalculatedDiscounts')
            ->willReturn(new ArrayObject([$this->calculatedDiscountTransferMock]));

        $this->orderTranserMock->expects(static::atLeastOnce())
            ->method('getPayments')
            ->willReturn(new ArrayObject([$this->paymentTransferMock]));

        $this->orderTranserMock->expects(static::atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->totalsTransferMock);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->shippingAddressTransferMock);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createMailjetTemplateVariablesAddressMapper')
            ->willReturn($this->mailjetTemplateVariablesAddressMapperMock);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createMailjetTemplateVariablesCalculatedDiscountsMapper')
            ->willReturn($this->mailjetTemplateVariablesCalculatedDiscountsMapperMock);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createMailjetTemplateVariablesPaymentsMapper')
            ->willReturn($this->mailjetTemplateVariablesPaymentsMapper);

        $this->mailjetTemplateVariablesCalculatedDiscountsMapperMock->expects(static::atLeastOnce())
            ->method('map')
            ->with(new ArrayObject([$this->calculatedDiscountTransferMock]))
            ->willReturn([]);

        $this->mailjetTemplateVariablesPaymentsMapper->expects(static::atLeastOnce())
            ->method('map')
            ->with(new ArrayObject([$this->paymentTransferMock]))
            ->willReturn([]);

        $this->mailjetTemplateVariablesAddressMapperMock->expects(static::atLeastOnce())
            ->method('map')
            ->with($this->billingAddressTransfer)
            ->willReturn([]);

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getOrderOrFail')
            ->willReturn($this->orderTranserMock);

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getOrder')
            ->willReturn($this->orderTranserMock);

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($this->localeTransferMock);

        $this->localeTransferMock->expects(static::atLeastOnce())
            ->method('getLocaleName')
            ->willReturn('en_US');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getOrderConfirmationEmailTemplateIdByLocale')
            ->with('en_US')
            ->willReturn(111);

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('setMailjetTemplate')
            ->willReturnSelf();

        static::assertEquals($this->mailTransferMock, $this->plugin->build($this->mailTransferMock));
    }
}
