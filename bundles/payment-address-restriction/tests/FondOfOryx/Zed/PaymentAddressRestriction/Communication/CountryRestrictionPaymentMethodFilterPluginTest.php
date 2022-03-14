<?php

namespace FondOfOryx\Zed\PaymentAddressRestriction\Communication;

use Codeception\Test\Unit;
use FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentAddressRestrictionFacade;
use FondOfOryx\Zed\PaymentAddressRestriction\PaymentAddressRestrictionConfig;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class CountryRestrictionPaymentMethodFilterPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    protected $paymentMethodsTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentAddressRestrictionFacade
     */
    protected $paymentCountryRestrictionFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentAddressRestriction\PaymentAddressRestrictionConfig
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\PaymentAddressRestriction\Communication\CountryRestrictionPaymentMethodFilterPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->paymentMethodsTransferMock = $this->getMockBuilder(PaymentMethodsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentCountryRestrictionFacadeMock = $this->getMockBuilder(PaymentAddressRestrictionFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(PaymentAddressRestrictionConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CountryRestrictionPaymentMethodFilterPlugin();
        $this->plugin->setFacade($this->paymentCountryRestrictionFacadeMock);
        $this->plugin->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethods(): void
    {
        $this->paymentCountryRestrictionFacadeMock->expects(static::atLeastOnce())
            ->method('filterPaymentMethods')
            ->with($this->paymentMethodsTransferMock, $this->quoteTransferMock)
            ->willReturn($this->paymentMethodsTransferMock);

        static::assertEquals(
            $this->paymentMethodsTransferMock,
            $this->plugin->filterPaymentMethods($this->paymentMethodsTransferMock, $this->quoteTransferMock),
        );
    }
}
