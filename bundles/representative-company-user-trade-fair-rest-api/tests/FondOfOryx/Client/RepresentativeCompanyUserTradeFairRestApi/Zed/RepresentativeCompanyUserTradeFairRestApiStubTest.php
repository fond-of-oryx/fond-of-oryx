<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer;

class RepresentativeCompanyUserTradeFairRestApiStubTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResponseTransferMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\Zed\RepresentativeCompanyUserTradeFairRestApiStub
     */
    protected $stub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRequestTransferMock = $this->getMockBuilder(RestRepresentativeCompanyUserTradeFairRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseTransferMock = $this->getMockBuilder(RestRepresentativeCompanyUserTradeFairResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stub = new RepresentativeCompanyUserTradeFairRestApiStub($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testAddTradeFairRepresentation(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                RepresentativeCompanyUserTradeFairRestApiStub::ADD_TRADE_FAIR_REPRESENTATION,
                $this->restRequestTransferMock,
            )->willReturn($this->restResponseTransferMock);

        static::assertEquals(
            $this->restResponseTransferMock,
            $this->stub->addTradeFairRepresentation($this->restRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetTradeFairRepresentation(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                RepresentativeCompanyUserTradeFairRestApiStub::GET_TRADE_FAIR_REPRESENTATION,
                $this->restRequestTransferMock,
            )->willReturn($this->restResponseTransferMock);

        static::assertEquals(
            $this->restResponseTransferMock,
            $this->stub->getTradeFairRepresentation($this->restRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testPatchTradeFairRepresentation(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                RepresentativeCompanyUserTradeFairRestApiStub::PATCH_TRADE_FAIR_REPRESENTATION,
                $this->restRequestTransferMock,
            )->willReturn($this->restResponseTransferMock);

        static::assertEquals(
            $this->restResponseTransferMock,
            $this->stub->patchTradeFairRepresentation($this->restRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testDeleteTradeFairRepresentation(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                RepresentativeCompanyUserTradeFairRestApiStub::DELETE_TRADE_FAIR_REPRESENTATION,
                $this->restRequestTransferMock,
            )->willReturn($this->restResponseTransferMock);

        static::assertEquals(
            $this->restResponseTransferMock,
            $this->stub->deleteTradeFairRepresentation($this->restRequestTransferMock),
        );
    }
}
