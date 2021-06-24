<?php

namespace FondOfOryx\Service\QrCodeGenerator;

use Codeception\Test\Unit;
use FondOfOryx\Service\QrCodeGenerator\Model\QrCode;
use FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface;
use FondOfOryx\Service\QrCodeGenerator\Model\QrCodeWriter;
use Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer;

class QrCodeGeneratorServiceTest extends Unit
{
    /**
     * @var \FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $qrCodeMock;

    /**
     * @var \FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper\QrCodeWrapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Service\QrCodeGenerator\Model\QrCodeWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $writerMock;

    /**
     * @var \Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $requestTransferMock;

    /**
     * @var \FondOfOryx\Service\QrCodeGenerator\QrCodeGeneratorService
     */
    protected $service;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->qrCodeMock = $this->getMockBuilder(QrCode::class)->disableOriginalConstructor()->getMock();
        $this->factoryMock = $this->getMockBuilder(QrCodeGeneratorServiceFactory::class)->disableOriginalConstructor()->getMock();
        $this->writerMock = $this->getMockBuilder(QrCodeWriter::class)->disableOriginalConstructor()->getMock();
        $this->requestTransferMock = $this->getMockBuilder(QrCodeGeneratorRequestTransfer::class)->disableOriginalConstructor()->getMock();

        $this->service = new class ($this->factoryMock) extends QrCodeGeneratorService {
            /**
             * @var \FondOfOryx\Service\QrCodeGenerator\QrCodeGeneratorServiceFactory
             */
            protected $ownFactory;

            /**
             *  constructor.
             *
             * @param \FondOfOryx\Service\QrCodeGenerator\QrCodeGeneratorServiceFactory $factory
             */
            public function __construct(QrCodeGeneratorServiceFactory $factory)
            {
                $this->ownFactory = $factory;
            }

            /**
             * @return \FondOfOryx\Service\QrCodeGenerator\QrCodeGeneratorServiceFactory
             */
            protected function getFactory()
            {
                return $this->ownFactory;
            }
        };
    }

    /**
     * @return void
     */
    public function testCreateQrCode(): void
    {
        $this->factoryMock->expects(static::once())->method('createQrCodeWriter')->willReturn($this->writerMock);
        $this->writerMock->expects(static::once())->method('generateQrCode')->willReturn($this->qrCodeMock);

        static::assertInstanceOf(QrCodeInterface::class, $this->service->createQrCode($this->requestTransferMock));
    }
}
