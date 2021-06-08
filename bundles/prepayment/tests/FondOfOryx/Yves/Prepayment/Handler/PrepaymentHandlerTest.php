<?php

namespace FondOfOryx\Yves\Prepayment\Handler;

use Codeception\Test\Unit;
use FondOfOryx\Shared\Prepayment\PrepaymentConstants;
use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class PrepaymentHandlerTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\PaymentTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paymentTransferMock;

    /**
     * @var \FondOfOryx\Yves\Prepayment\Handler\PrepaymentHandler
     */
    protected $handler;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)->disableOriginalConstructor()->getMock();
        $this->paymentTransferMock = $this->getMockBuilder(PaymentTransfer::class)->disableOriginalConstructor()->getMock();

        $this->handler = new PrepaymentHandler();
    }

    /**
     * @return void
     */
    public function testAddPaymentToQuote(): void
    {
        $self = $this;
        $this->quoteTransferMock->expects(static::once())->method('getPayment')->willReturn($this->paymentTransferMock);
        $this->quoteTransferMock->expects(static::once())->method('setPayment');
        $this->paymentTransferMock->expects(static::once())->method('setPaymentProvider')->willReturnCallback(static function ($string) use ($self) {
            static::assertSame($string, PrepaymentConstants::PROVIDER_NAME);

            return $self->paymentTransferMock;
        });
        $this->paymentTransferMock->expects(static::once())->method('setPaymentMethod')->willReturnCallback(static function ($string) use ($self) {
            static::assertSame($string, PrepaymentConstants::PAYMENT_METHOD_PREPAYMENT);

            return $self->paymentTransferMock;
        });

        $this->handler->addPaymentToQuote($this->quoteTransferMock);
    }
}
