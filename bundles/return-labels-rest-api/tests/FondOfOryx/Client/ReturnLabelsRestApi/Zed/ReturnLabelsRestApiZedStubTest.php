<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client\ReturnLabelsRestApiToZedRequestClientBridge;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\RestReturnLabelResponseTransfer;

class ReturnLabelsRestApiZedStubTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client\ReturnLabelsRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelsRestApiToZedRequestClientBridgeMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestTransferMock;

    /**
     * @var \FondOfOryx\Client\ReturnLabelsRestApi\Zed\ReturnLabelsRestApiZedStub;
     */
    protected $returnLabelsRestApiZedStub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->returnLabelsRestApiToZedRequestClientBridgeMock = $this->getMockBuilder(ReturnLabelsRestApiToZedRequestClientBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelRequestTransferMock = $this->getMockBuilder(RestReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelResponseTransferMock = $this->getMockBuilder(RestReturnLabelResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelsRestApiZedStub = new ReturnLabelsRestApiZedStub($this->returnLabelsRestApiToZedRequestClientBridgeMock);
    }

    /**
     * @return void
     */
    public function testGenerateReturnLabel(): void
    {
        $this->returnLabelsRestApiToZedRequestClientBridgeMock->expects(static::atLeastOnce())
            ->method('call')
            ->willReturn($this->restReturnLabelResponseTransferMock);

        static::assertInstanceOf(
            RestReturnLabelResponseTransfer::class,
            $this->returnLabelsRestApiZedStub->generateReturnLabel($this->restReturnLabelRequestTransferMock),
        );
    }
}
