<?php

namespace FondOfOryx\Zed\PaymentTotalAmountRestriction\Business\PaymentMethodFilter;

use Codeception\Test\Unit;
use FondOfOryx\Zed\PaymentTotalAmountRestriction\PaymentTotalAmountRestrictionConfig;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\PaymentMethodTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\TotalsTransfer;

class PaymentTotalAmountRestrictionPaymentMethodFilterTest extends Unit
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\TotalsTransfer
     */
    protected $totalsTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentTotalAmountRestriction\PaymentTotalAmountRestrictionConfig
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\PaymentTotalAmountRestriction\Business\PaymentMethodFilter\PaymentTotalAmountRestrictionPaymentMethodFilter
     */
    protected $paymentMethodFilter;

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

        $this->totalsTransferMock = $this->getMockBuilder(TotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(PaymentTotalAmountRestrictionConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentMethodFilter = new PaymentTotalAmountRestrictionPaymentMethodFilter($this->configMock);
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethods(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getTotalAmountRestrictedPaymentMethodCombinations')
            ->willReturn(['payment-method-to-remove' => 2000]);

        $this->paymentMethodsTransferMock->expects(static::atLeastOnce())
            ->method('getMethods')
            ->willReturn([$this->paymentMethodTransferMock]);

        $this->paymentMethodTransferMock->expects(static::atLeastOnce())
            ->method('getMethodName')
            ->willReturn('payment-method-to-remove');

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->totalsTransferMock);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getGrandTotal')
            ->willReturn(1000);

        $this->paymentMethodsTransferMock->expects(static::atLeastOnce())
            ->method('setMethods')
            ->willReturnSelf();

        $paymentMethodsTransfer = $this->paymentMethodFilter->filterPaymentMethods(
            $this->paymentMethodsTransferMock,
            $this->quoteTransferMock,
        );

        static::assertCount(1, $paymentMethodsTransfer->getMethods());
    }
}
