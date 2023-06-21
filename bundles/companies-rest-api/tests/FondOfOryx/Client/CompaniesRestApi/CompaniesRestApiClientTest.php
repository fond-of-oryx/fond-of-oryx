<?php

namespace FondOfOryx\Client\CompaniesRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompaniesRestApi\Zed\CompaniesRestApiStubInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompaniesRestApiClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\CompaniesRestApi\CompaniesRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Client\CompaniesRestApi\Zed\CompaniesRestApiStubInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedStubMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Client\CompaniesRestApi\CompaniesRestApiClient
     */
    protected $client;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompaniesRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedStubMock = $this->getMockBuilder(CompaniesRestApiStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->client = new CompaniesRestApiClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testFindCompaniesRestApis(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createZedCompaniesRestApiStub')
            ->willReturn($this->zedStubMock);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('deleteCompany')
            ->with($this->companyTransferMock)
            ->willReturn($this->companyTransferMock);

        static::assertEquals(
            $this->companyTransferMock,
            $this->client->deleteCompany($this->companyTransferMock),
        );
    }
}
