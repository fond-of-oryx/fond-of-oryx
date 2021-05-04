<?php

namespace FondOfOryx\Client\SplittableTotalsRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\SplittableTotalsRestApi\Zed\SplittableTotalsRestApiZedStubInterface;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;

class SplittableTotalsRestApiClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\SplittableTotalsRestApi\SplittableTotalsRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsResponseTransferMock;

    /**
     * @var \FondOfOryx\Client\SplittableTotalsRestApi\Zed\SplittableTotalsRestApiZedStubInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedStubMock;

    /**
     * @var \FondOfOryx\Client\SplittableTotalsRestApi\SplittableTotalsRestApiClient
     */
    protected $client;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(SplittableTotalsRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsRequestTransferMock = $this->getMockBuilder(RestSplittableTotalsRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsResponseTransferMock = $this->getMockBuilder(RestSplittableTotalsResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedStubMock = $this->getMockBuilder(SplittableTotalsRestApiZedStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->client = new SplittableTotalsRestApiClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testGetSplittableTotals(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createSplittableTotalsRestApiZedStub')
            ->willReturn($this->zedStubMock);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('getSplittableTotals')
            ->with($this->restSplittableTotalsRequestTransferMock)
            ->willReturn($this->restSplittableTotalsResponseTransferMock);

        static::assertEquals(
            $this->restSplittableTotalsResponseTransferMock,
            $this->client->getSplittableTotals($this->restSplittableTotalsRequestTransferMock)
        );
    }
}
