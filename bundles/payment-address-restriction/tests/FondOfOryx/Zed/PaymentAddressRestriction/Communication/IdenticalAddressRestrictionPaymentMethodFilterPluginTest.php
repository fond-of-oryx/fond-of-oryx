<?php

namespace FondOfOryx\Zed\PaymentAddressRestriction\Communication;

use Codeception\Test\Unit;
use FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentAddressRestrictionFacade;
use FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter\CountryRestrictionRestrictionPaymentMethodFilter;
use FondOfOryx\Zed\PaymentAddressRestriction\PaymentAddressRestrictionConfig;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class IdenticalAddressRestrictionPaymentMethodFilterPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    protected MockObject|PaymentMethodsTransfer $paymentMethodsTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected MockObject|QuoteTransfer $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentAddressRestrictionFacade
     */
    protected PaymentAddressRestrictionFacade|MockObject $paymentCountryRestrictionFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentAddressRestriction\PaymentAddressRestrictionConfig
     */
    protected PaymentAddressRestrictionConfig|MockObject $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter\CountryRestrictionRestrictionPaymentMethodFilter
     */
    protected CountryRestrictionRestrictionPaymentMethodFilter|MockObject $countryRestrictionRestrictionPaymentMethodFilter;

    /**
     * @var \FondOfOryx\Zed\PaymentAddressRestriction\Communication\IdenticalAddressRestrictionPaymentMethodFilterPlugin
     */
    protected IdenticalAddressRestrictionPaymentMethodFilterPlugin $plugin;

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

        $this->plugin = new IdenticalAddressRestrictionPaymentMethodFilterPlugin();
        $this->plugin->setFacade($this->paymentCountryRestrictionFacadeMock);
        $this->plugin->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethods(): void
    {
        $this->paymentCountryRestrictionFacadeMock->expects(static::atLeastOnce())
            ->method('identicalAddressRestrictionPaymentMethodFilter')
            ->with($this->paymentMethodsTransferMock, $this->quoteTransferMock)
            ->willReturn($this->paymentMethodsTransferMock);

        static::assertEquals(
            $this->paymentMethodsTransferMock,
            $this->plugin->filterPaymentMethods($this->paymentMethodsTransferMock, $this->quoteTransferMock),
        );
    }
}
