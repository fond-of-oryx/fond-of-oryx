<?php

namespace FondOfOryx\Service\QrCodeGenerator\Model;

use Codeception\Test\Unit;
use Endroid\QrCode\Writer\Result\ResultInterface;

class QrCodeTest extends Unit
{
    /**
     * @var \Endroid\QrCode\Writer\Result\ResultInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $resultMock;

    /**
     * @var \FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface
     */
    protected $qrCode;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->resultMock = $this->getMockBuilder(ResultInterface::class)->disableOriginalConstructor()->getMock();

        $this->qrCode = new QrCode();
    }

    /**
     * @return void
     */
    public function testGetMimeType(): void
    {
        $this->resultMock->expects(static::once())->method('getMimeType')->willReturn('mimeType');
        $qrCode = $this->qrCode->init($this->resultMock);
        static::assertSame('mimeType', $qrCode->getMimeType());
    }

    /**
     * @return void
     */
    public function testGetDataUri(): void
    {
        $this->resultMock->expects(static::once())->method('getDataUri')->willReturn('dataUri');
        $qrCode = $this->qrCode->init($this->resultMock);
        static::assertSame('dataUri', $qrCode->getDataUri());
    }

    /**
     * @return void
     */
    public function testGetString(): void
    {
        $this->resultMock->expects(static::once())->method('getString')->willReturn('string');
        $qrCode = $this->qrCode->init($this->resultMock);
        static::assertSame('string', $qrCode->getString());
    }

    /**
     * @return void
     */
    public function testSaveToFile(): void
    {
        $this->resultMock->expects(static::once())->method('saveToFile');
        $qrCode = $this->qrCode->init($this->resultMock);
        $qrCode->saveToFile('test');
    }
}
