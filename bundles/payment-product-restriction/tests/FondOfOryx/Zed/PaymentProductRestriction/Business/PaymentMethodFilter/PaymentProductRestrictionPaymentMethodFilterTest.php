<?php

namespace FondOfOryx\Zed\PaymentProductRestriction\Business\PaymentMethodFilter;

use Codeception\Test\Unit;
use FondOfOryx\Shared\PaymentProductRestriction\PaymentProductRestrictionConstants;
use FondOfOryx\Zed\PaymentProductRestriction\PaymentProductRestrictionConfig;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\PaymentMethodTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class PaymentProductRestrictionPaymentMethodFilterTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    protected $paymentMethodsTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaymentMethodTransfer
     */
    protected $paymentMethodTransferMock1;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaymentMethodTransfer
     */
    protected $paymentMethodTransferMock2;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaymentMethodTransfer
     */
    protected $paymentMethodTransferMock3;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ItemTransfer
     */
    protected $itemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentProductRestriction\PaymentProductRestrictionConfig
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\PaymentProductRestriction\Business\PaymentMethodFilter\PaymentProductRestrictionBySkuPaymentMethodFilter
     */
    protected $paymentProductRestrictionPaymentMethodFilter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->paymentMethodsTransferMock = $this->getMockBuilder(PaymentMethodsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentMethodTransferMock1 = $this->getMockBuilder(PaymentMethodTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentMethodTransferMock2 = $this->getMockBuilder(PaymentMethodTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentMethodTransferMock3 = $this->getMockBuilder(PaymentMethodTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(PaymentProductRestrictionConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentProductRestrictionPaymentMethodFilter = new PaymentProductRestrictionPaymentMethodFilter($this->configMock);
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethods(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getMappingBlacklistedPaymentMethods')
            ->willReturn(['payment-method-to-remove' => ['invoice' => 'payment_provider_invoice']]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getProductAttributeBlacklistedPaymentMethods')
            ->willReturn('blacklisted_payment_methods');

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn([$this->itemTransferMock]);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getAbstractAttributes')
            ->willReturn([
        PaymentProductRestrictionConstants::UNLOCALIZED_PRODUCHT_ATTRIBUTES => [
                'blacklisted_payment_methods' => [
                    'payment_provider_invoice',
                ],
            ]]);

        $this->paymentMethodTransferMock1->expects(static::atLeastOnce())
            ->method('getMethodName')
            ->willReturn('payment_provider_invoice');

        $this->paymentMethodTransferMock2->expects(static::atLeastOnce())
            ->method('getMethodName')
            ->willReturn('payment_provider_paypal');

        $this->paymentMethodTransferMock3->expects(static::atLeastOnce())
            ->method('getMethodName')
            ->willReturn('payment_provider_credit-card');

        $this->paymentMethodsTransferMock->expects(static::atLeastOnce())
            ->method('getMethods')
            ->willReturn([$this->paymentMethodTransferMock1, $this->paymentMethodTransferMock2, $this->paymentMethodTransferMock3]);

        $paymentMethodsTransfer = $this->paymentProductRestrictionPaymentMethodFilter->filterPaymentMethods(
            $this->paymentMethodsTransferMock,
            $this->quoteTransferMock,
        );

        static::assertCount(2, $paymentMethodsTransfer->getMethods());
    }
}
