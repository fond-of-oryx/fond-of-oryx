<?php

namespace FondOfOryx\Client\CompanySearchRestApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanySearchRestApi\Dependency\Client\CompanySearchRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CompanyListTransfer;

class CompanySearchRestApiStubTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyListTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyListTransferMock;

    /**
     * @var \FondOfOryx\Client\CompanySearchRestApi\Dependency\Client\CompanySearchRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\CompanySearchRestApi\Zed\CompanySearchRestApiStub
     */
    protected $companySearchRestApiStub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyListTransferMock = $this->getMockBuilder(CompanyListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(CompanySearchRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companySearchRestApiStub = new CompanySearchRestApiStub(
            $this->zedRequestClientMock
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
                '/company-search-rest-api/gateway/search-companies',
                $this->companyListTransferMock
            )->willReturn($this->companyListTransferMock);

        static::assertEquals(
            $this->companyListTransferMock,
            $this->companySearchRestApiStub->searchCompanies($this->companyListTransferMock)
        );
    }
}
