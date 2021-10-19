<?php

namespace FondOfOryx\Client\CompanyUserSearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanyUserSearchRestApi\Zed\CompanyUserSearchRestApiStubInterface;
use Generated\Shared\Transfer\CompanyUserListTransfer;

class CompanyUserSearchRestApiClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\CompanyUserSearchRestApi\CompanyUserSearchRestApiFactory|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Client\CompanyUserSearchRestApi\Zed\CompanyUserSearchRestApiStubInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedStubMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserListTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserListTransferMock;

    /**
     * @var \FondOfOryx\Client\CompanyUserSearchRestApi\CompanyUserSearchRestApiClient
     */
    protected $client;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompanyUserSearchRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedStubMock = $this->getMockBuilder(CompanyUserSearchRestApiStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserListTransferMock = $this->getMockBuilder(CompanyUserListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->client = new CompanyUserSearchRestApiClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testSearchCompanies(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createZedCompanyUserSearchRestApiStub')
            ->willReturn($this->zedStubMock);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('searchCompanyUser')
            ->with($this->companyUserListTransferMock)
            ->willReturn($this->companyUserListTransferMock);

        static::assertEquals(
            $this->companyUserListTransferMock,
            $this->client->searchCompanyUser($this->companyUserListTransferMock)
        );
    }
}
