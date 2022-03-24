<?php

namespace FondOfOryx\Zed\PaymentProductRestriction\Business\PaymentMethodFilter;

use Codeception\Test\Unit;
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
    protected $paymentMethodTransferMock;

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
     * @var \FondOfOryx\Zed\PaymentProductRestriction\Business\PaymentMethodFilter\PaymentProductRestrictionPaymentMethodFilter
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

        $this->paymentMethodTransferMock = $this->getMockBuilder(PaymentMethodTransfer::class)
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
            ->method('getBlacklistedProductSkuPaymentMethodCombinations')
            ->willReturn(['payment-method-to-remove' => ['SKU-000', 'SKU-001', 'SKU-002']]);

        $this->paymentMethodsTransferMock->expects(static::atLeastOnce())
            ->method('getMethods')
            ->willReturn([$this->paymentMethodTransferMock]);

        $this->paymentMethodTransferMock->expects(static::atLeastOnce())
            ->method('getMethodName')
            ->willReturn('payment-method-to-remove');

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn([$this->itemTransferMock]);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('SKU-000-XXX-XXX');

        $this->paymentMethodsTransferMock->expects(static::atLeastOnce())
            ->method('setMethods')
            ->willReturnSelf();

        $paymentMethodsTransfer = $this->paymentProductRestrictionPaymentMethodFilter->filterPaymentMethods(
            $this->paymentMethodsTransferMock,
            $this->quoteTransferMock,
        );

        static::assertCount(1, $paymentMethodsTransfer->getMethods());
    }
}
