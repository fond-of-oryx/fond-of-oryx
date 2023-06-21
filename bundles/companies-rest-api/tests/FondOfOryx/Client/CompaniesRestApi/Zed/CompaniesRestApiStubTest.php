<?php

namespace FondOfOryx\Client\CompaniesRestApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompaniesRestApi\Dependency\Client\CompaniesRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompaniesRestApiStubTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Client\CompaniesRestApi\Dependency\Client\CompaniesRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\CompaniesRestApi\Zed\CompaniesRestApiStub
     */
    protected $stub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(CompaniesRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stub = new CompaniesRestApiStub($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testDeleteCompany(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                CompaniesRestApiStub::DELETE_COMPANY,
                $this->companyTransferMock,
            )->willReturn($this->companyTransferMock);

        static::assertEquals(
            $this->companyTransferMock,
            $this->stub->deleteCompany($this->companyTransferMock),
        );
    }
}
