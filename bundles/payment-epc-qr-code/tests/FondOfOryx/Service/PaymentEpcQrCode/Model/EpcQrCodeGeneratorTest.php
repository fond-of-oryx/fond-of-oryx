<?php

namespace FondOfOryx\Service\PaymentEpcQrCode\Model\Builder;

use Codeception\Test\Unit;
use FondOfOryx\Service\PaymentEpcQrCode\Dependency\Service\PaymentEpcQrCodeToQrCodeGeneratorServiceBridge;
use FondOfOryx\Service\PaymentEpcQrCode\Model\EpcQrCodeGenerator;
use FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeConfig;
use FondOfOryx\Service\QrCodeGenerator\Model\QrCode;
use Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer;

class EpcQrCodeGeneratorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $requestTransferMock;

    /**
     * @var \FondOfOryx\Service\PaymentEpcQrCode\Model\Builder\EpcDataBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $dataBuilderMock;

    /**
     * @var \FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Service\PaymentEpcQrCode\Dependency\Service\PaymentEpcQrCodeToQrCodeGeneratorServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $serviceMock;

    /**
     * @var \FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $qrCodeMock;

    /**
     * @var \FondOfOryx\Service\PaymentEpcQrCode\Model\EpcQrCodeGeneratorInterface
     */
    protected $generator;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->requestTransferMock = $this->getMockBuilder(PaymentEpcQrCodeRequestTransfer::class)->disableOriginalConstructor()->getMock();
        $this->dataBuilderMock = $this->getMockBuilder(EpcDataBuilder::class)->disableOriginalConstructor()->getMock();
        $this->configMock = $this->getMockBuilder(PaymentEpcQrCodeConfig::class)->disableOriginalConstructor()->getMock();
        $this->serviceMock = $this->getMockBuilder(PaymentEpcQrCodeToQrCodeGeneratorServiceBridge::class)->disableOriginalConstructor()->getMock();
        $this->qrCodeMock = $this->getMockBuilder(QrCode::class)->disableOriginalConstructor()->getMock();

        $this->generator = new EpcQrCodeGenerator($this->dataBuilderMock, $this->serviceMock, $this->configMock);
    }

    /**
     * @return void
     */
    public function testGenerateEpcQrCode(): void
    {
        $this->configMock->expects(static::once())->method('getEncoding')->willReturn('utf-8');
        $this->configMock->expects(static::once())->method('getForegroundColor')->willReturn(['0', '0', '0']);
        $this->configMock->expects(static::once())->method('getBackgroundColor')->willReturn(['255', '255', '255']);
        $this->configMock->expects(static::once())->method('getMargin')->willReturn(10);
        $this->configMock->expects(static::once())->method('getSize')->willReturn(300);
        $this->configMock->expects(static::once())->method('getErrorCorrectionLevel')->willReturn(1);
        $this->configMock->expects(static::once())->method('getFormat')->willReturn('png');
        $this->configMock->expects(static::once())->method('getRoundedBlockSizeMode')->willReturn(1);
        $this->dataBuilderMock->expects(static::once())->method('fromTransfer')->willReturn('dataString');
        $this->serviceMock->expects(static::once())->method('createQrCode')->willReturn($this->qrCodeMock);

        $this->generator->generateEpcQrCode($this->requestTransferMock);
    }

    /**
     * @return void
     */
    public function testGenerateEpcQrCodeWithColorMismatch(): void
    {
        $this->configMock->expects(static::once())->method('getEncoding')->willReturn('utf-8');
        $this->configMock->expects(static::once())->method('getForegroundColor');
        $this->configMock->expects(static::once())->method('getBackgroundColor')->willReturn(['255', '255']);
        $this->configMock->expects(static::once())->method('getMargin')->willReturn(10);
        $this->configMock->expects(static::once())->method('getSize')->willReturn(300);
        $this->configMock->expects(static::once())->method('getErrorCorrectionLevel')->willReturn(1);
        $this->configMock->expects(static::once())->method('getFormat')->willReturn('png');
        $this->configMock->expects(static::once())->method('getRoundedBlockSizeMode')->willReturn(1);
        $this->dataBuilderMock->expects(static::once())->method('fromTransfer')->willReturn('dataString');
        $this->serviceMock->expects(static::once())->method('createQrCode')->willReturn($this->qrCodeMock);

        $this->generator->generateEpcQrCode($this->requestTransferMock);
    }
}
