<?php

namespace FondOfOryx\Client\CompanyBusinessUnitSearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Zed\CompanyBusinessUnitSearchRestApiStubInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;

class CompanyBusinessUnitSearchRestApiClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiFactory|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Zed\CompanyBusinessUnitSearchRestApiStubInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedStubMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
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
            $this->client->searchCompanyBusinessUnit($this->companyBusinessUnitListTransferMock)
        );
    }
}
