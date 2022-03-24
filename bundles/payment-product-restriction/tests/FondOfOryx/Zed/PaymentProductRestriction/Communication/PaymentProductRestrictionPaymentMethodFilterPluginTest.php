<?php

namespace FondOfOryx\Zed\PaymentProductRestriction\Communication;

use Codeception\Test\Unit;
use FondOfOryx\Zed\PaymentProductRestriction\Business\PaymentProductRestrictionFacade;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class PaymentProductRestrictionPaymentMethodFilterPluginTest extends Unit
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentProductRestriction\Business\PaymentProductRestrictionFacade
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\PaymentProductRestriction\Communication\PaymentProductRestrictionPaymentMethodFilterPlugin
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

        $this->facadeMock = $this->getMockBuilder(PaymentProductRestrictionFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new PaymentProductRestrictionPaymentMethodFilterPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethods(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('productRestrictionPaymentMethodFilter')
            ->with($this->paymentMethodsTransferMock, $this->quoteTransferMock)
            ->willReturn($this->paymentMethodsTransferMock);

        $paymentMethodsTransfer = $this->plugin->filterPaymentMethods(
            $this->paymentMethodsTransferMock,
            $this->quoteTransferMock,
        );

        static::assertEquals($paymentMethodsTransfer, $this->paymentMethodsTransferMock);
    }
}
