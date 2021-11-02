<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\RestReturnLabelResponseTransfer;
use Spryker\Client\ZedRequest\ZedRequestClient;

class ReturnLabelsRestApiToZedRequestClientBridgeTest extends Unit
{
    /**
     * @var \Spryker\Client\ZedRequest\ZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelResponseTransferMock;

    /**
     * @var \FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client\ReturnLabelsRestApiToZedRequestClientInterface
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->zedRequestClientMock = $this->getMockBuilder(ZedRequestClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelRequestTransferMock = $this->getMockBuilder(RestReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelResponseTransferMock = $this->getMockBuilder(RestReturnLabelResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new ReturnLabelsRestApiToZedRequestClientBridge($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testCall(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->willReturn($this->restReturnLabelResponseTransferMock);

        $response = $this->bridge->call(
            '/return-labels-rest-api/gateway/generate-return-label',
            $this->restReturnLabelRequestTransferMock,
        );

        static::assertInstanceOf(
            RestReturnLabelResponseTransfer::class,
            $response,
        );
    }
}
