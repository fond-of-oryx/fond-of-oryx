<?php

namespace FondOfOryx\Client\CompanySearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanySearchRestApi\Zed\CompanySearchRestApiStubInterface;
use Generated\Shared\Transfer\CompanyListTransfer;

class CompanySearchRestApiClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\CompanySearchRestApi\CompanySearchRestApiFactory|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Client\CompanySearchRestApi\Zed\CompanySearchRestApiStubInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedStubMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyListTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyListTransferMock;

    /**
     * @var \FondOfOryx\Client\CompanySearchRestApi\CompanySearchRestApiClient
     */
    protected $client;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompanySearchRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedStubMock = $this->getMockBuilder(CompanySearchRestApiStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyListTransferMock = $this->getMockBuilder(CompanyListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->client = new CompanySearchRestApiClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testSearchCompanies(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createZedCompanySearchRestApiStub')
            ->willReturn($this->zedStubMock);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('searchCompanies')
            ->with($this->companyListTransferMock)
            ->willReturn($this->companyListTransferMock);

        static::assertEquals(
            $this->companyListTransferMock,
            $this->client->searchCompanies($this->companyListTransferMock)
        );
    }
}
