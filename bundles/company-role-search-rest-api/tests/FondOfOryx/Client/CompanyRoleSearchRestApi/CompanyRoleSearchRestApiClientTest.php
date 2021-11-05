<?php

namespace FondOfOryx\Client\CompanyRoleSearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanyRoleSearchRestApi\Zed\CompanyRoleSearchRestApiStubInterface;
use Generated\Shared\Transfer\CompanyRoleListTransfer;

class CompanyRoleSearchRestApiClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiFactory|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Client\CompanyRoleSearchRestApi\Zed\CompanyRoleSearchRestApiStubInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $zedStubMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyRoleListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyRoleListTransferMock;

    /**
     * @var \FondOfOryx\Client\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiClient
     */
    protected $client;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompanyRoleSearchRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedStubMock = $this->getMockBuilder(CompanyRoleSearchRestApiStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleListTransferMock = $this->getMockBuilder(CompanyRoleListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->client = new CompanyRoleSearchRestApiClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testSearchCompanieRole(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createZedCompanyRoleSearchRestApiStub')
            ->willReturn($this->zedStubMock);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('searchCompanyRoles')
            ->with($this->companyRoleListTransferMock)
            ->willReturn($this->companyRoleListTransferMock);

        static::assertEquals(
            $this->companyRoleListTransferMock,
            $this->client->searchCompanyRoles($this->companyRoleListTransferMock),
        );
    }
}
