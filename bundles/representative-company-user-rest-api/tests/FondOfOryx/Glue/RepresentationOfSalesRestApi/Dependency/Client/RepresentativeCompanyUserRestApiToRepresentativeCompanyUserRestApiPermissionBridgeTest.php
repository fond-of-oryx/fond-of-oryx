<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Dependency\Client;

use Codeception\Test\Unit;
use FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\RepresentativeCompanyUserRestApiPermissionClientInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer;

class RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\RepresentativeCompanyUserRestApiPermissionClientInterface
     */
    protected $clientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer
     */
    protected $requestMock;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->clientMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiPermissionClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiPermissionRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionBridge($this->clientMock);
    }

    /**
     * @return void
     */
    public function testHasPermissionToManageGlobalRepresentations(): void
    {
        $this->clientMock->expects(static::atLeastOnce())
            ->method('hasPermissionToManageGlobalRepresentations')
            ->with($this->requestMock)
            ->willReturn(true);

        $this->bridge->hasPermissionToManageGlobalRepresentations($this->requestMock);
    }

    /**
     * @return void
     */
    public function testHasPermissionToManageOwnRepresentations(): void
    {
        $this->clientMock->expects(static::atLeastOnce())
            ->method('hasPermissionToManageOwnRepresentations')
            ->with($this->requestMock)
            ->willReturn(true);

        $this->bridge->hasPermissionToManageOwnRepresentations($this->requestMock);
    }
}
