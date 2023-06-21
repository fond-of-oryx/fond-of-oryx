<?php

namespace FondOfOryx\Client\CompaniesRestApiPermission;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompaniesRestApiPermission\Zed\CompaniesRestApiPermissionStubInterface;
use Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer;
use Generated\Shared\Transfer\CompaniesRestApiPermissionResponseTransfer;

class CompaniesRestApiPermissionClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\CompaniesRestApiPermission\CompaniesRestApiPermissionFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Client\CompaniesRestApiPermission\Zed\CompaniesRestApiPermissionStubInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedStubMock;

    /**
     * @var \Generated\Shared\Transfer\CompaniesRestApiPermissionResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companiesRestApiPermissionResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companiesRestApiPermissionRequestTransferMock;

    /**
     * @var \FondOfOryx\Client\CompaniesRestApiPermission\CompaniesRestApiPermissionClient
     */
    protected $client;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompaniesRestApiPermissionFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedStubMock = $this->getMockBuilder(CompaniesRestApiPermissionStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesRestApiPermissionResponseTransferMock = $this->getMockBuilder(CompaniesRestApiPermissionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesRestApiPermissionRequestTransferMock = $this->getMockBuilder(CompaniesRestApiPermissionRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->client = new CompaniesRestApiPermissionClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testHasPermissionToDeleteCompany(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompaniesRestApiPermissionStub')
            ->willReturn($this->zedStubMock);

        $this->companiesRestApiPermissionResponseTransferMock->expects(static::atLeastOnce())
            ->method('getHasPermissionToDelete')
            ->willReturn(true);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('hasPermissionToDeleteCompany')
            ->with($this->companiesRestApiPermissionRequestTransferMock)
            ->willReturn($this->companiesRestApiPermissionResponseTransferMock);

        static::assertTrue(
            $this->client->hasPermissionToDeleteCompany($this->companiesRestApiPermissionRequestTransferMock),
        );
    }
}
