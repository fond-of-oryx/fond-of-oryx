<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\Zed\RepresentativeCompanyUserTradeFairRestApiStubInterface;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer;

class RepresentativeCompanyUserTradeFairRestApiClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\Zed\RepresentativeCompanyUserTradeFairRestApiStubInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedStubMock;

    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResponseTransferMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiClient
     */
    protected $client;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedStubMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestTransferMock = $this->getMockBuilder(RestRepresentativeCompanyUserTradeFairRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseTransferMock = $this->getMockBuilder(RestRepresentativeCompanyUserTradeFairResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->client = new RepresentativeCompanyUserTradeFairRestApiClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testAddTradeFairRepresentation(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createZedRepresentativeCompanyUserTradeFairRestApiStub')
            ->willReturn($this->zedStubMock);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('addTradeFairRepresentation')
            ->with($this->restRequestTransferMock)
            ->willReturn($this->restResponseTransferMock);

        static::assertEquals(
            $this->restResponseTransferMock,
            $this->client->addTradeFairRepresentation($this->restRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetTradeFairRepresentation(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createZedRepresentativeCompanyUserTradeFairRestApiStub')
            ->willReturn($this->zedStubMock);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('getTradeFairRepresentation')
            ->with($this->restRequestTransferMock)
            ->willReturn($this->restResponseTransferMock);

        static::assertEquals(
            $this->restResponseTransferMock,
            $this->client->getTradeFairRepresentation($this->restRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testPatchTradeFairRepresentation(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createZedRepresentativeCompanyUserTradeFairRestApiStub')
            ->willReturn($this->zedStubMock);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('patchTradeFairRepresentation')
            ->with($this->restRequestTransferMock)
            ->willReturn($this->restResponseTransferMock);

        static::assertEquals(
            $this->restResponseTransferMock,
            $this->client->patchTradeFairRepresentation($this->restRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testDeleteTradeFairRepresentation(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createZedRepresentativeCompanyUserTradeFairRestApiStub')
            ->willReturn($this->zedStubMock);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('deleteTradeFairRepresentation')
            ->with($this->restRequestTransferMock)
            ->willReturn($this->restResponseTransferMock);

        static::assertEquals(
            $this->restResponseTransferMock,
            $this->client->deleteTradeFairRepresentation($this->restRequestTransferMock),
        );
    }
}
