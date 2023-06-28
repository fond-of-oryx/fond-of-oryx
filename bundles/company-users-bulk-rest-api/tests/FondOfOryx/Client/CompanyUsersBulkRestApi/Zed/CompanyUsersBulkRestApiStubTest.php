<?php

namespace FondOfOryx\Client\CompanyUsersBulkRestApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanyUsersBulkRestApi\Dependency\Client\CompanyUsersBulkRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkResponseTransfer;

class CompanyUsersBulkRestApiStubTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUsersBulkResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResponseTransferMock;

    /**
     * @var \FondOfOryx\Client\CompanyUsersBulkRestApi\Dependency\Client\CompanyUsersBulkRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\CompanyUsersBulkRestApi\Zed\CompanyUsersBulkRestApiStub
     */
    protected $stub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRequestTransferMock = $this->getMockBuilder(RestCompanyUsersBulkRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseTransferMock = $this->getMockBuilder(RestCompanyUsersBulkResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(CompanyUsersBulkRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stub = new CompanyUsersBulkRestApiStub($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testAddRepresentation(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                CompanyUsersBulkRestApiStub::BULK_PROCESS,
                $this->restRequestTransferMock,
            )->willReturn($this->restResponseTransferMock);

        static::assertEquals(
            $this->restResponseTransferMock,
            $this->stub->bulkProcess($this->restRequestTransferMock),
        );
    }
}
