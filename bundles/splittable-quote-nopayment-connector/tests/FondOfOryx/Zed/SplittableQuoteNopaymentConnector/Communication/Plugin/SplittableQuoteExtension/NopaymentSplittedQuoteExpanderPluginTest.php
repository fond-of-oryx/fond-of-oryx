<?php

namespace FondOfOryx\Zed\SplittableQuoteNopaymentConnector\Communication\Plugin\SplittableQuoteExtension;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\TotalsTransfer;
use Spryker\Shared\Nopayment\NopaymentConfig;

class NopaymentSplittedQuoteExpanderPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\TotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $totalsTransferMock;

    /**
     * @var \Generated\Shared\Transfer\PaymentTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paymentTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableQuoteNopaymentConnector\Communication\Plugin\SplittableQuoteExtension\NopaymentSplittedQuoteExpanderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->totalsTransferMock = $this->getMockBuilder(TotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentTransferMock = $this->getMockBuilder(PaymentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new NopaymentSplittedQuoteExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->totalsTransferMock);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getPriceToPay')
            ->willReturn(0);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getPayment')
            ->willReturn($this->paymentTransferMock);

        $this->paymentTransferMock->expects(static::atLeastOnce())
            ->method('setPaymentSelection')
            ->with(NopaymentConfig::PAYMENT_METHOD_NAME)
            ->willReturn($this->paymentTransferMock);

        $this->paymentTransferMock->expects(static::atLeastOnce())
            ->method('setPaymentProvider')
            ->with(NopaymentConfig::PAYMENT_PROVIDER_NAME)
            ->willReturn($this->paymentTransferMock);

        $this->paymentTransferMock->expects(static::atLeastOnce())
            ->method('setPaymentMethod')
            ->with(NopaymentConfig::PAYMENT_METHOD_NAME)
            ->willReturn($this->paymentTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->plugin->expand($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithPriceToPayGreaterThenZero(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->totalsTransferMock);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getPriceToPay')
            ->willReturn(1);

        $this->quoteTransferMock->expects(static::never())
            ->method('getPayment');

        static::assertEquals(
            $this->quoteTransferMock,
            $this->plugin->expand($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutPayment(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->totalsTransferMock);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getPriceToPay')
            ->willReturn(0);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getPayment')
            ->willReturn(null);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->plugin->expand($this->quoteTransferMock),
        );
    }
}
