<?php

namespace FondOfOryx\Glue\CompaniesRestApi\Dependency\Client;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompaniesRestApiPermission\CompaniesRestApiPermissionClientInterface;
use Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer;

class CompaniesRestApiToCompaniesRestApiPermissionBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\CompaniesRestApiPermission\CompaniesRestApiPermissionClientInterface
     */
    protected $clientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer
     */
    protected $requestMock;

    /**
     * @var \FondOfOryx\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompaniesRestApiPermissionBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->clientMock = $this->getMockBuilder(CompaniesRestApiPermissionClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock = $this->getMockBuilder(CompaniesRestApiPermissionRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new CompaniesRestApiToCompaniesRestApiPermissionBridge($this->clientMock);
    }

    /**
     * @return void
     */
    public function testHasPermissionToDeleteCompany(): void
    {
        $this->clientMock->expects(static::atLeastOnce())
            ->method('hasPermissionToDeleteCompany')
            ->with($this->requestMock)
            ->willReturn(true);

        $this->bridge->hasPermissionToDeleteCompany($this->requestMock);
    }
}
