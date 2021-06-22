<?php

namespace FondOfOryx\Service\QrCodeGenerator\Model;

use Codeception\Test\Unit;
use FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper\QrCodeWrapper;
use Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer;

class QrCodeWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $qrCodeMock;

    /**
     * @var \FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper\QrCodeWrapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $wrapperMock;

    /**
     * @var \Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $requestTransferMock;

    /**
     * @var \FondOfOryx\Service\QrCodeGenerator\Model\QrCodeWriterInterface
     */
    protected $writer;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->qrCodeMock = $this->getMockBuilder(QrCode::class)->disableOriginalConstructor()->getMock();
        $this->wrapperMock = $this->getMockBuilder(QrCodeWrapper::class)->disableOriginalConstructor()->getMock();
        $this->requestTransferMock = $this->getMockBuilder(QrCodeGeneratorRequestTransfer::class)->disableOriginalConstructor()->getMock();

        $this->writer = new QrCodeWriter($this->wrapperMock, $this->qrCodeMock);
    }

    /**
     * @return void
     */
    public function testGenerateQrCode(): void
    {
        $clone = clone $this->qrCodeMock;
        $this->qrCodeMock->expects(static::once())->method('init')->willReturn($clone);
        $this->wrapperMock->expects(static::once())->method('createQrCode')->willReturn($this->qrCodeMock);
        $qrCode = $this->writer->generateQrCode($this->requestTransferMock);
        static::assertNotSame($this->qrCodeMock, $qrCode);
    }
}
