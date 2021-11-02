<?php

namespace FondOfOryx\Client\CompanyUserSearchRestApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanyUserSearchRestApi\Dependency\Client\CompanyUserSearchRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CompanyUserListTransfer;

class CompanyUserSearchRestApiStubTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyUserListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyUserListTransferMock;

    /**
     * @var \FondOfOryx\Client\CompanyUserSearchRestApi\Dependency\Client\CompanyUserSearchRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\CompanyUserSearchRestApi\Zed\CompanyUserSearchRestApiStub
     */
    protected $companySearchRestApiStub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUserListTransferMock = $this->getMockBuilder(CompanyUserListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(CompanyUserSearchRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companySearchRestApiStub = new CompanyUserSearchRestApiStub(
            $this->zedRequestClientMock,
        );
    }

    /**
     * @return void
     */
    public function testSearchCompanies(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                '/company-user-search-rest-api/gateway/search-company-user',
                $this->companyUserListTransferMock,
            )->willReturn($this->companyUserListTransferMock);

        static::assertEquals(
            $this->companyUserListTransferMock,
            $this->companySearchRestApiStub->searchCompanyUser($this->companyUserListTransferMock),
        );
    }
}
