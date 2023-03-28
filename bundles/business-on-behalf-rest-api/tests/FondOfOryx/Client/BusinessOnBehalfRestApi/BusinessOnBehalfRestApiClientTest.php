<?php

namespace FondOfOryx\Client\BusinessOnBehalfRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\BusinessOnBehalfRestApi\Zed\BusinessOnBehalfRestApiZedStubInterface;
use Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class BusinessOnBehalfRestApiClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|BusinessOnBehalfRestApiFactory $factoryMock;

    /**
     * @var \Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestBusinessOnBehalfRequestTransfer|MockObject $restBusinessOnBehalfRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestBusinessOnBehalfResponseTransfer|MockObject $restBusinessOnBehalfResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestSplittableTotalsResponseTransfer|MockObject $restSplittableTotalsResponseTransferMock;

    /**
     * @var \FondOfOryx\Client\BusinessOnBehalfRestApi\Zed\BusinessOnBehalfRestApiZedStubInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected BusinessOnBehalfRestApiZedStubInterface|MockObject $zedStubMock;

    /**
     * @var \FondOfOryx\Client\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiClient
     */
    protected BusinessOnBehalfRestApiClient $client;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(BusinessOnBehalfRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restBusinessOnBehalfRequestTransferMock = $this->getMockBuilder(RestBusinessOnBehalfRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restBusinessOnBehalfResponseTransferMock = $this->getMockBuilder(RestBusinessOnBehalfResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsResponseTransferMock = $this->getMockBuilder(RestSplittableTotalsResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedStubMock = $this->getMockBuilder(BusinessOnBehalfRestApiZedStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->client = new BusinessOnBehalfRestApiClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testSetDefaultCompanyUserByRestBusinessOnBehalfRequest(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createBusinessOnBehalfRestApiZedStub')
            ->willReturn($this->zedStubMock);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('setDefaultCompanyUserByRestBusinessOnBehalfRequest')
            ->with($this->restBusinessOnBehalfRequestTransferMock)
            ->willReturn($this->restBusinessOnBehalfResponseTransferMock);

        static::assertEquals(
            $this->restBusinessOnBehalfResponseTransferMock,
            $this->client->setDefaultCompanyUserByRestBusinessOnBehalfRequest(
                $this->restBusinessOnBehalfRequestTransferMock,
            ),
        );
    }
}
