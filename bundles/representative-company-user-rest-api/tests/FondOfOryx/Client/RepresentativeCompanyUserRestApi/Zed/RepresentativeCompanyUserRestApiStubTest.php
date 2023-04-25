<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserRestApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer;

class RepresentativeCompanyUserRestApiStubTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResponseTransferMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserRestApi\Zed\RepresentativeCompanyUserRestApiStub
     */
    protected $stub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRequestTransferMock = $this->getMockBuilder(RestRepresentativeCompanyUserRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseTransferMock = $this->getMockBuilder(RestRepresentativeCompanyUserResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stub = new RepresentativeCompanyUserRestApiStub($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testAddRepresentation(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                RepresentativeCompanyUserRestApiStub::ADD_REPRESENTATION,
                $this->restRequestTransferMock,
            )->willReturn($this->restResponseTransferMock);

        static::assertEquals(
            $this->restResponseTransferMock,
            $this->stub->addRepresentation($this->restRequestTransferMock),
        );
    }
}
