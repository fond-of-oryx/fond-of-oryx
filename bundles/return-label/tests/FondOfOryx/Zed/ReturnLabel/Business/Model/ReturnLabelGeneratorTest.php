<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapter;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use GuzzleHttp\Psr7\Stream;

class ReturnLabelGeneratorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelAdapterMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestTransferMock;

    /**
     * @var \Psr\Http\Message\StreamInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $streamMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Model\ReturnLabelGeneratorInterface
     */
    protected $generator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->returnLabelAdapterMock = $this->getMockBuilder(ReturnLabelAdapter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(ReturnLabelConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestTransferMock = $this->getMockBuilder(ReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->streamMock = $this->getMockBuilder(Stream::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->generator = new ReturnLabelGenerator(
            $this->returnLabelAdapterMock,
            $this->configMock
        );
    }

    /**
     * @return void
     */
    public function testGenerateSuccess(): void
    {
        $qrCode = true;
        $returnForm = true;
        $data = 'Rm9vQmFy';

        $this->configMock->expects(static::atLeastOnce())
            ->method('printQrCodeOnReturnForm')
            ->willReturn($qrCode);

        $this->returnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('setQrCode')
            ->with($qrCode)
            ->willReturn($this->returnLabelRequestTransferMock);

        $this->configMock->expects(static::atLeastOnce())
            ->method('appendReturnForm')
            ->willReturn($returnForm);

        $this->returnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('setReturnForm')
            ->with($returnForm)
            ->willReturn($this->returnLabelRequestTransferMock);

        $this->returnLabelAdapterMock->expects(static::atLeastOnce())
            ->method('sendRequest')
            ->with($this->returnLabelRequestTransferMock)
            ->willReturn($this->streamMock);

        $this->streamMock->expects(static::atLeastOnce())
            ->method('getContents')
            ->willReturn($data);

        $returnLabelResponseTransfer = $this->generator->generate($this->returnLabelRequestTransferMock);

        static::assertTrue($returnLabelResponseTransfer->getIsSuccessful());
        static::assertEquals(
            $data,
            $returnLabelResponseTransfer->getReturnLabel()->getData()
        );
    }
}
