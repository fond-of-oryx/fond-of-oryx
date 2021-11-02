<?php

namespace FondOfOryx\Service\PaymentEpcQrCode\Model\Builder;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeService;
use FondOfOryx\Service\QrCodeGenerator\Model\QrCode;
use FondOfOryx\Shared\Prepayment\PrepaymentConstants;
use FondOfOryx\Zed\PaymentEpcQrCode\Business\Model\Expander\PaymentEpcQrCodeExpander;
use FondOfOryx\Zed\PaymentEpcQrCode\PaymentEpcQrCodeConfig;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\TotalsTransfer;

class PaymentEpcQrCodeExpanderTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\PaymentTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paymentTransferMock;

    /**
     * @var \Generated\Shared\Transfer\TotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $totalsTransferMock;

    /**
     * @var \FondOfOryx\Zed\PaymentEpcQrCode\PaymentEpcQrCodeConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $qrCodeMock;

    /**
     * @var \FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $serviceMock;

    /**
     * @var \FondOfOryx\Zed\PaymentEpcQrCode\Business\Model\Expander\ExpanderInterface
     */
    protected $expander;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->qrCodeMock = $this->getMockBuilder(QrCode::class)->disableOriginalConstructor()->getMock();
        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)->disableOriginalConstructor()->getMock();
        $this->paymentTransferMock = $this->getMockBuilder(PaymentTransfer::class)->disableOriginalConstructor()->getMock();
        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)->disableOriginalConstructor()->getMock();
        $this->totalsTransferMock = $this->getMockBuilder(TotalsTransfer::class)->disableOriginalConstructor()->getMock();
        $this->configMock = $this->getMockBuilder(PaymentEpcQrCodeConfig::class)->disableOriginalConstructor()->getMock();
        $this->serviceMock = $this->getMockBuilder(PaymentEpcQrCodeService::class)->disableOriginalConstructor()->getMock();

        $this->expander = new PaymentEpcQrCodeExpander($this->serviceMock, $this->configMock);
    }

    /**
     * @return void
     */
    public function testExpandOnPrepayment(): void
    {
        $this->serviceMock->expects(static::once())->method('createEpcQrCode')->willReturn($this->qrCodeMock);
        $this->orderTransferMock->expects(static::once())->method('getPayments')->willReturn([$this->paymentTransferMock]);
        $this->orderTransferMock->expects(static::once())->method('getTotals')->willReturn($this->totalsTransferMock);
        $this->orderTransferMock->expects(static::once())->method('getCurrencyIsoCode')->willReturn('EUR');
        $this->orderTransferMock->expects(static::once())->method('getOrderReference')->willReturn('Ref');
        $this->orderTransferMock->expects(static::once())->method('setPrepaymentEpcQrData')->willReturn($this->orderTransferMock);
        $this->totalsTransferMock->expects(static::once())->method('getPriceToPay')->willReturn(3900);
        $this->paymentTransferMock->expects(static::once())->method('getPaymentMethod')->willReturn(PrepaymentConstants::PAYMENT_METHOD_PREPAYMENT);
        $this->mailTransferMock->expects(static::once())->method('getOrder')->willReturn($this->orderTransferMock);
        $this->mailTransferMock->expects(static::once())->method('setOrder')->willReturn($this->mailTransferMock);

        $this->configMock->expects(static::once())->method('getEpcDataServiceTag')->willReturn('tag');
        $this->configMock->expects(static::once())->method('getEpcDataVersion')->willReturn('version');
        $this->configMock->expects(static::once())->method('getEpcDataEncoding')->willReturn('UTF-8');
        $this->configMock->expects(static::once())->method('getEpcDataType')->willReturn('type');
        $this->configMock->expects(static::once())->method('getEpcDataBic')->willReturn('bic');
        $this->configMock->expects(static::once())->method('getEpcDataReceiverName')->willReturn('holder');
        $this->configMock->expects(static::once())->method('getEpcDataIban')->willReturn('iban');
        $this->configMock->expects(static::once())->method('getEpcDataPurpose')->willReturn('purpose');

        $this->qrCodeMock->expects(static::once())->method('getDataUri')->willReturn('dataImageUrl');

        $this->expander->expand($this->mailTransferMock, $this->orderTransferMock);
    }

    /**
     * @return void
     */
    public function testExpandOnPrepaymentEncodingNotKnownException(): void
    {
        $this->orderTransferMock->expects(static::once())->method('getPayments')->willReturn([$this->paymentTransferMock]);
        $this->paymentTransferMock->expects(static::once())->method('getPaymentMethod')->willReturn(PrepaymentConstants::PAYMENT_METHOD_PREPAYMENT);
        $this->mailTransferMock->expects(static::once())->method('getOrder')->willReturn($this->orderTransferMock);

        $this->configMock->expects(static::once())->method('getEpcDataServiceTag')->willReturn('tag');
        $this->configMock->expects(static::once())->method('getEpcDataVersion')->willReturn('version');
        $this->configMock->expects(static::once())->method('getEpcDataEncoding')->willReturn('fail');

        $exception = null;
        try {
            $this->expander->expand($this->mailTransferMock, $this->orderTransferMock);
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNotNull($exception);
        static::assertSame(
            'Encoding fail not known! Please chose one from UTF-8,ISO 8859-1,ISO 8859-2,ISO 8859-4,ISO 8859-5,ISO 8859-7,ISO 8859-10,ISO 8859-15',
            $exception->getMessage(),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithNoPrepayment(): void
    {
        $this->orderTransferMock->expects(static::once())->method('getPayments')->willReturn([$this->paymentTransferMock]);
        $this->paymentTransferMock->expects(static::once())->method('getPaymentMethod')->willReturn('cc');
        $this->mailTransferMock->expects(static::never())->method('getOrder');

        $this->expander->expand($this->mailTransferMock, $this->orderTransferMock);
    }
}
