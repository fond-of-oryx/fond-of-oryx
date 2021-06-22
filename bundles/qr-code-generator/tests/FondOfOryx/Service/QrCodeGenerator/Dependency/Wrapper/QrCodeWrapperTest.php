<?php

namespace FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper;

use Codeception\Test\Unit;
use Endroid\QrCode\Writer\Result\ResultInterface;
use Endroid\QrCode\Writer\WriterInterface;
use Exception;
use FondOfOryx\Service\QrCodeGenerator\QrCodeGeneratorConfig;
use Generated\Shared\Transfer\QrCodeColorConfigurationTransfer;
use Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer;

class QrCodeWrapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Service\QrCodeGenerator\QrCodeGeneratorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper\WriterCollectionInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $writerCollectionMock;

    /**
     * @var \Endroid\QrCode\Writer\WriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $writerMock;

    /**
     * @var \Endroid\QrCode\Writer\Result\ResultInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $resultMock;

    /**
     * @var \Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $requestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QrCodeColorConfigurationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $colorConfigTransferMock;

    /**
     * @var \FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper\QrCodeWrapperInterface
     */
    protected $wrapper;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->resultMock = $this->getMockBuilder(ResultInterface::class)->disableOriginalConstructor()->getMock();
        $this->configMock = $this->getMockBuilder(QrCodeGeneratorConfig::class)->disableOriginalConstructor()->getMock();
        $this->writerMock = $this->getMockBuilder(WriterInterface::class)->disableOriginalConstructor()->getMock();
        $this->writerCollectionMock = $this->getMockBuilder(WriterCollection::class)->disableOriginalConstructor()->getMock();
        $this->requestTransferMock = $this->getMockBuilder(QrCodeGeneratorRequestTransfer::class)->disableOriginalConstructor()->getMock();
        $this->colorConfigTransferMock = $this->getMockBuilder(QrCodeColorConfigurationTransfer::class)->disableOriginalConstructor()->getMock();

        $this->wrapper = new QrCodeWrapper($this->writerCollectionMock, $this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateQrCodeFromConfigData(): void
    {
        $this->requestTransferMock->expects(static::once())->method('getData')->willReturn('test');
        $this->configMock->expects(static::once())->method('getEncoding')->willReturn('UTF-8');
        $this->configMock->expects(static::once())->method('getMargin')->willReturn(10);
        $this->configMock->expects(static::once())->method('getErrorCorrectionLevel')->willReturn(1);
        $this->configMock->expects(static::once())->method('getRoundedBlockSizeMode')->willReturn(1);
        $this->configMock->expects(static::once())->method('getForegroundColor')->willReturn([0, 0, 0]);
        $this->configMock->expects(static::once())->method('getBackgroundColor')->willReturn([255, 255, 255]);
        $this->configMock->expects(static::once())->method('getSize')->willReturn(300);
        $this->writerCollectionMock->expects(static::once())->method('get')->willReturn($this->writerMock);
        $this->writerMock->expects(static::once())->method('write')->willReturn($this->resultMock);

        $this->wrapper->createQrCode($this->requestTransferMock);
    }

    /**
     * @return void
     */
    public function testCreateQrCodeFromTransferData(): void
    {
        $this->colorConfigTransferMock->expects(static::exactly(2))->method('getRed')->willReturn(155);
        $this->colorConfigTransferMock->expects(static::exactly(2))->method('getGreen')->willReturn(155);
        $this->colorConfigTransferMock->expects(static::exactly(2))->method('getBlue')->willReturn(155);
        $this->requestTransferMock->expects(static::once())->method('getData')->willReturn('test');
        $this->requestTransferMock->expects(static::once())->method('getEncoding')->willReturn('UTF-8');
        $this->requestTransferMock->expects(static::once())->method('getMargin')->willReturn(10);
        $this->requestTransferMock->expects(static::once())->method('getErrorCorrectionLevel')->willReturn(1);
        $this->requestTransferMock->expects(static::once())->method('getRoundedBlockSizeMode')->willReturn(1);
        $this->requestTransferMock->expects(static::once())->method('getForegroundColor')->willReturn($this->colorConfigTransferMock);
        $this->requestTransferMock->expects(static::once())->method('getBackgroundColor')->willReturn($this->colorConfigTransferMock);
        $this->configMock->expects(static::once())->method('getForegroundColor')->willReturn([]);
        $this->configMock->expects(static::once())->method('getBackgroundColor')->willReturn([]);
        $this->requestTransferMock->expects(static::once())->method('getSize')->willReturn(300);
        $this->writerCollectionMock->expects(static::once())->method('get')->willReturn($this->writerMock);
        $this->writerMock->expects(static::once())->method('write')->willReturn($this->resultMock);

        $this->wrapper->createQrCode($this->requestTransferMock);
    }

    /**
     * @return void
     */
    public function testCreateQrCodeFromConfigDataCreateColorWillThrowMissingValueException(): void
    {
        $this->requestTransferMock->expects(static::once())->method('getData')->willReturn('test');
        $this->configMock->expects(static::once())->method('getEncoding')->willReturn('UTF-8');
        $this->configMock->expects(static::once())->method('getMargin')->willReturn(10);
        $this->configMock->expects(static::once())->method('getErrorCorrectionLevel')->willReturn(1);
        $this->configMock->expects(static::once())->method('getRoundedBlockSizeMode')->willReturn(1);
        $this->configMock->expects(static::once())->method('getForegroundColor')->willReturn([0, 0]);
        $this->writerCollectionMock->expects(static::once())->method('get')->willReturn($this->writerMock);

        $exception = null;
        try {
            $this->wrapper->createQrCode($this->requestTransferMock);
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertInstanceOf(Exception::class, $exception);
        static::assertSame('Missing color value! Array in format [255, 255, 255] needed. Possible values 0 - 255', $exception->getMessage());
    }

    /**
     * @return void
     */
    public function testCreateQrCodeFromConfigDataCreateColorWillThrowMismatchException(): void
    {
        $this->requestTransferMock->expects(static::once())->method('getData')->willReturn('test');
        $this->configMock->expects(static::once())->method('getEncoding')->willReturn('UTF-8');
        $this->configMock->expects(static::once())->method('getMargin')->willReturn(10);
        $this->configMock->expects(static::once())->method('getErrorCorrectionLevel')->willReturn(1);
        $this->configMock->expects(static::once())->method('getRoundedBlockSizeMode')->willReturn(1);
        $this->configMock->expects(static::once())->method('getForegroundColor')->willReturn([0, 0, 500]);
        $this->writerCollectionMock->expects(static::once())->method('get')->willReturn($this->writerMock);

        $exception = null;
        try {
            $this->wrapper->createQrCode($this->requestTransferMock);
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertInstanceOf(Exception::class, $exception);
        static::assertSame('Color mismatch! Red, green, blue (0 - 255) required. Given red: 0, green: 0, blue: 500', $exception->getMessage());
    }

    /**
     * @return void
     */
    public function testCreateQrCodeFromConfigDataBlockSizeException(): void
    {
        $this->requestTransferMock->expects(static::once())->method('getData')->willReturn('test');
        $this->configMock->expects(static::once())->method('getEncoding')->willReturn('UTF-8');
        $this->configMock->expects(static::once())->method('getMargin')->willReturn(10);
        $this->configMock->expects(static::once())->method('getErrorCorrectionLevel')->willReturn(1);
        $this->configMock->expects(static::once())->method('getRoundedBlockSizeMode')->willReturn(100);
        $this->writerCollectionMock->expects(static::once())->method('get')->willReturn($this->writerMock);

        $exception = null;
        try {
            $this->wrapper->createQrCode($this->requestTransferMock);
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertInstanceOf(Exception::class, $exception);
        static::assertSame('Mode 100 not known. Please chose from 0 to 3 (none, margin, large, shrink)', $exception->getMessage());
    }

    /**
     * @return void
     */
    public function testCreateQrCodeFromConfigDataErrorLevel(): void
    {
        $this->requestTransferMock->expects(static::once())->method('getData')->willReturn('test');
        $this->configMock->expects(static::once())->method('getEncoding')->willReturn('UTF-8');
        $this->configMock->expects(static::once())->method('getMargin')->willReturn(10);
        $this->configMock->expects(static::once())->method('getErrorCorrectionLevel')->willReturn(100);
        $this->writerCollectionMock->expects(static::once())->method('get')->willReturn($this->writerMock);

        $exception = null;
        try {
            $this->wrapper->createQrCode($this->requestTransferMock);
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertInstanceOf(Exception::class, $exception);
        static::assertSame('Error level 100 not known. Please chose from 0 to 3 (low, medium, high, quartile)', $exception->getMessage());
    }
}
