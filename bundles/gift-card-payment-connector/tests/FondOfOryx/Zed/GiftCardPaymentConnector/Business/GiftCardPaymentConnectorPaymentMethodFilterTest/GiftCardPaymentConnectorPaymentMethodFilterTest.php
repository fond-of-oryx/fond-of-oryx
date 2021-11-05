<?php

namespace FondOfOryx\Zed\GiftCardPaymentConnector\Business\PaymentMethodFilter;

use Codeception\Test\Unit;
use FondOfOryx\Shared\GiftCardPaymentConnector\GiftCardPaymentConnectorConstants;
use FondOfOryx\Zed\GiftCardPaymentConnector\GiftCardPaymentConnectorConfig;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\PaymentMethodTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class GiftCardPaymentConnectorPaymentMethodFilterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardPaymentConnector\GiftCardPaymentConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\PaymentMethodsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paymentMethodsTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardPaymentConnector\Business\PaymentMethodFilter\GiftCardPaymentConnectorPaymentMethodFilter
     */
    protected $giftCardPaymentConnectorPaymentMethodFilter;

    /**
     * @var \Generated\Shared\Transfer\PaymentTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paymentTransferMock;

    /**
     * @var \Generated\Shared\Transfer\PaymentMethodTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paymentMethodTransfer;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(GiftCardPaymentConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentMethodsTransferMock = $this->getMockBuilder(PaymentMethodsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentTransferMock = $this->getMockBuilder(PaymentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentMethodTransfer = $this->getMockBuilder(PaymentMethodTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardPaymentConnectorPaymentMethodFilter = new GiftCardPaymentConnectorPaymentMethodFilter($this->configMock);
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethodsIsNotUsingGiftCard(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getPayments')
            ->willReturn([$this->paymentTransferMock]);

        $this->paymentTransferMock->expects(static::atLeastOnce())
            ->method('getPaymentMethod')
            ->willReturn('allowed_payment_method');

        $paymentMethodsTransfer = $this->giftCardPaymentConnectorPaymentMethodFilter->filterPaymentMethods($this->paymentMethodsTransferMock, $this->quoteTransferMock);

        static::assertEquals($this->paymentMethodsTransferMock, $paymentMethodsTransfer);
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethodsIsUsingGiftCard(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getPayments')
            ->willReturn([$this->paymentTransferMock]);

        $this->paymentTransferMock->expects(static::atLeastOnce())
            ->method('getPaymentMethod')
            ->willReturn(GiftCardPaymentConnectorConstants::PAYMENT_PROVIDER_GIFT_CARD);

        $this->paymentMethodsTransferMock->expects(static::atLeastOnce())
            ->method('getMethods')
            ->willReturn([$this->paymentMethodTransfer]);

        $this->paymentMethodTransfer->expects(static::atLeastOnce())
            ->method('getMethodName')
            ->willReturn('PAYPAL');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getNotAllowedPaymentMethods')
            ->willReturn(['prepaymentPrepayment']);

        $this->paymentMethodsTransferMock->expects(static::atLeastOnce())
            ->method('setMethods')
            ->willReturnSelf();

        $paymentMethodsTransfer = $this->giftCardPaymentConnectorPaymentMethodFilter->filterPaymentMethods($this->paymentMethodsTransferMock, $this->quoteTransferMock);

        static::assertEquals($this->paymentMethodsTransferMock, $paymentMethodsTransfer);
    }
}
