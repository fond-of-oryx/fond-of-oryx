<?php

namespace FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Dependency\Client\CompanyBusinessUnitSearchRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;

class CompanyBusinessUnitSearchRestApiStubTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitListTransferMock;

    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Dependency\Client\CompanyBusinessUnitSearchRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Zed\CompanyBusinessUnitSearchRestApiStub
     */
    protected $companySearchRestApiStub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitListTransferMock = $this->getMockBuilder(CompanyBusinessUnitListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(CompanyBusinessUnitSearchRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companySearchRestApiStub = new CompanyBusinessUnitSearchRestApiStub(
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
                '/company-business-unit-search-rest-api/gateway/search-company-business-unit',
                $this->companyBusinessUnitListTransferMock
            )->willReturn($this->companyBusinessUnitListTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitListTransferMock,
            $this->companySearchRestApiStub->searchCompanyBusinessUnit($this->companyBusinessUnitListTransferMock)
        );
    }
}
