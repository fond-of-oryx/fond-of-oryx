<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission;

use Codeception\Test\Unit;
use FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\Zed\RepresentativeCompanyUserRestApiPermissionStubInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionResponseTransfer;

class RepresentativeCompanyUserRestApiPermissionClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\RepresentativeCompanyUserRestApiPermissionFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\Zed\RepresentativeCompanyUserRestApiPermissionStubInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedStubMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserRestApiPermissionResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserRestApiPermissionRequestTransferMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\RepresentativeCompanyUserRestApiPermissionClient
     */
    protected $client;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiPermissionFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedStubMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiPermissionStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserRestApiPermissionResponseTransferMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiPermissionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserRestApiPermissionRequestTransferMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiPermissionRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->client = new RepresentativeCompanyUserRestApiPermissionClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testHasPermissionToManageGlobalRepresentations(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createRepresentativeCompanyUserRestApiPermissionStub')
            ->willReturn($this->zedStubMock);

        $this->representativeCompanyUserRestApiPermissionResponseTransferMock->expects(static::atLeastOnce())
            ->method('getHasPermissionToManageGlobalRepresentations')
            ->willReturn(true);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('hasPermissionToManageGlobalRepresentations')
            ->with($this->representativeCompanyUserRestApiPermissionRequestTransferMock)
            ->willReturn($this->representativeCompanyUserRestApiPermissionResponseTransferMock);

        static::assertTrue(
            $this->client->hasPermissionToManageGlobalRepresentations($this->representativeCompanyUserRestApiPermissionRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testHasPermissionToManageOwnRepresentations(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createRepresentativeCompanyUserRestApiPermissionStub')
            ->willReturn($this->zedStubMock);

        $this->representativeCompanyUserRestApiPermissionResponseTransferMock->expects(static::atLeastOnce())
            ->method('getHasPermissionToManageOwnRepresentations')
            ->willReturn(true);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('hasPermissionToManageOwnRepresentations')
            ->with($this->representativeCompanyUserRestApiPermissionRequestTransferMock)
            ->willReturn($this->representativeCompanyUserRestApiPermissionResponseTransferMock);

        static::assertTrue(
            $this->client->hasPermissionToManageOwnRepresentations($this->representativeCompanyUserRestApiPermissionRequestTransferMock),
        );
    }
}
