<?php

namespace FondOfOryx\Zed\PayoneCreditMemo\Communication\Plugin\CreditMemoExtension\Processor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\PayoneCreditMemo\Communication\PayoneCreditMemoCommunicationFactory;
use FondOfOryx\Zed\PayoneCreditMemo\PayoneCreditMemoConfig;
use Generated\Shared\Transfer\CreditMemoProcessorStatusTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\PaymentMethodTransfer;
use Generated\Shared\Transfer\PaymentProviderTransfer;
use Generated\Shared\Transfer\SalesPaymentMethodTypeTransfer;

class PayoneCreditMemoProcessorPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CreditMemoTransfer
     */
    protected $creditMemoTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CreditMemoProcessorStatusTransfer
     */
    protected $statusResponseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PayoneCreditMemo\Communication\PayoneCreditMemoCommunicationFactory
     */
    protected $communicationFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PayoneCreditMemo\PayoneCreditMemoConfig
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaymentProviderTransfer
     */
    protected $paymentProviderTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\SalesPaymentMethodTypeTransfer
     */
    protected $salesPaymentMethodTypeTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaymentMethodTransfer
     */
    protected $paymentMethodTransferMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->creditMemoTransferMock = $this->getMockBuilder(CreditMemoTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->statusResponseMock = $this->getMockBuilder(CreditMemoProcessorStatusTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->communicationFactoryMock = $this->getMockBuilder(PayoneCreditMemoCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(PayoneCreditMemoConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentProviderTransferMock = $this->getMockBuilder(PaymentProviderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesPaymentMethodTypeTransferMock = $this->getMockBuilder(SalesPaymentMethodTypeTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentMethodTransferMock = $this->getMockBuilder(PaymentMethodTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new PayoneCreditMemoProcessorPlugin();
        $this->plugin->setConfig($this->configMock);
        $this->plugin->setFactory($this->communicationFactoryMock);
    }

    /**
     * @return void
     */
    public function testProcess(): void
    {
        static::assertInstanceOf(
            CreditMemoProcessorStatusTransfer::class,
            $this->plugin->process($this->creditMemoTransferMock, $this->statusResponseMock),
        );
    }

    /**
     * @return void
     */
    public function testGetName(): void
    {
        static::assertEquals(PayoneCreditMemoProcessorPlugin::NAME, $this->plugin->getName());
    }

    /**
     * @return void
     */
    public function testCanProcessIsFalse(): void
    {
        static::assertFalse($this->plugin->canProcess($this->creditMemoTransferMock));
    }

    /**
     * @return void
     */
    public function testCanProcessIsTrue(): void
    {
        $this->creditMemoTransferMock->expects(static::atLeastOnce())
            ->method('getSalesPaymentMethodType')
            ->willReturn($this->salesPaymentMethodTypeTransferMock);

        $this->salesPaymentMethodTypeTransferMock->expects(static::atLeastOnce())
            ->method('getPaymentProvider')
            ->willReturn($this->paymentProviderTransferMock);

        $this->paymentProviderTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn(PayoneCreditMemoProcessorPlugin::LISTENING_PAYMENT_PROVIDER);

        $this->salesPaymentMethodTypeTransferMock->expects(static::atLeastOnce())
            ->method('getPaymentMethod')
            ->willReturn($this->paymentMethodTransferMock);

        $this->paymentMethodTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn('payment-method');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getListeningPaymentMethods')
            ->willReturn(['payment-method']);

        static::assertTrue($this->plugin->canProcess($this->creditMemoTransferMock));
    }
}
