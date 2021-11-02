<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\ReturnLabelsRestApi\Zed\ReturnLabelsRestApiZedStub;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\RestReturnLabelResponseTransfer;

class ReturnLabelsRestApiClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Client\ReturnLabelsRestApi\Zed\ReturnLabelsRestApiZedStubInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelZedStubMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelResponseTransfer;

    /**
     * @var \FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClientInterface
     */
    protected $client;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->factoryMock = $this->getMockBuilder(ReturnLabelsRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelZedStubMock = $this->getMockBuilder(ReturnLabelsRestApiZedStub::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelRequestTransferMock = $this->getMockBuilder(RestReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelResponseTransfer = $this->getMockBuilder(RestReturnLabelResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->client = new ReturnLabelsRestApiClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testGenerateReturnLabel(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createReturnLabelZedStub')
            ->willReturn($this->returnLabelZedStubMock);

        $this->returnLabelZedStubMock->expects(static::atLeastOnce())
            ->method('generateReturnLabel')
            ->willReturn($this->restReturnLabelResponseTransfer);

        $response = $this->client->generateReturnLabel($this->restReturnLabelRequestTransferMock);

        static::assertInstanceOf(
            RestReturnLabelResponseTransfer::class,
            $response,
        );
    }
}
