<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Communication\Plugin\Payment;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductPaymentRestriction\Business\ProductPaymentRestrictionFacade;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class ProductPaymentRestrictionPaymentMethodFilterPluginTest extends Unit
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductPaymentRestriction\Business\ProductPaymentRestrictionFacade
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\ProductPaymentRestriction\Communication\Plugin\Payment\ProductPaymentRestrictionPaymentMethodFilterPlugin
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

        $this->facadeMock = $this->getMockBuilder(ProductPaymentRestrictionFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new ProductPaymentRestrictionPaymentMethodFilterPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethods(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('ProductPaymentRestrictionPaymentMethodFilter')
            ->with($this->paymentMethodsTransferMock, $this->quoteTransferMock)
            ->willReturn($this->paymentMethodsTransferMock);

        $paymentMethodsTransfer = $this->plugin->filterPaymentMethods(
            $this->paymentMethodsTransferMock,
            $this->quoteTransferMock,
        );

        static::assertEquals($paymentMethodsTransfer, $this->paymentMethodsTransferMock);
    }
}
