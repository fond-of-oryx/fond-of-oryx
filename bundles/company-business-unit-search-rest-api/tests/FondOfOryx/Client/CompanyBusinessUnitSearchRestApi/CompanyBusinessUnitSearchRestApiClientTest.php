<?php

namespace FondOfOryx\Client\CompanyBusinessUnitSearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Zed\CompanyBusinessUnitSearchRestApiStubInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;

class CompanyBusinessUnitSearchRestApiClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiFactory|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Zed\CompanyBusinessUnitSearchRestApiStubInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $zedStubMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyBusinessUnitListTransferMock;

    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiClient
     */
    protected $client;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompanyBusinessUnitSearchRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedStubMock = $this->getMockBuilder(CompanyBusinessUnitSearchRestApiStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitListTransferMock = $this->getMockBuilder(CompanyBusinessUnitListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->client = new CompanyBusinessUnitSearchRestApiClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testSearchCompanies(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createZedCompanyBusinessUnitSearchRestApiStub')
            ->willReturn($this->zedStubMock);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('searchCompanyBusinessUnit')
            ->with($this->companyBusinessUnitListTransferMock)
            ->willReturn($this->companyBusinessUnitListTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitListTransferMock,
            $this->client->searchCompanyBusinessUnit($this->companyBusinessUnitListTransferMock),
        );
    }
}
