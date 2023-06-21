<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\Dependency\Client\RepresentativeCompanyUserRestApiPermissionToZedRequestInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionResponseTransfer;

class RepresentativeCompanyUserRestApiPermissionStubTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserRestApiPermissionRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserRestApiPermissionResponseTransferMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\Dependency\Client\RepresentativeCompanyUserRestApiPermissionToZedRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\Zed\RepresentativeCompanyUserRestApiPermissionStub
     */
    protected $stub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->representativeCompanyUserRestApiPermissionRequestTransferMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiPermissionRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserRestApiPermissionResponseTransferMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiPermissionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiPermissionToZedRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stub = new RepresentativeCompanyUserRestApiPermissionStub($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testHasPermissionToManageGlobalRepresentations(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                '/representative-company-user-rest-api-permission/gateway/has-permission-to-manage-global-representations',
                $this->representativeCompanyUserRestApiPermissionRequestTransferMock,
            )->willReturn($this->representativeCompanyUserRestApiPermissionResponseTransferMock);

        static::assertEquals(
            $this->representativeCompanyUserRestApiPermissionResponseTransferMock,
            $this->stub->hasPermissionToManageGlobalRepresentations($this->representativeCompanyUserRestApiPermissionRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testHasPermissionToManageOwnRepresentations(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                '/representative-company-user-rest-api-permission/gateway/has-permission-to-manage-own-representations',
                $this->representativeCompanyUserRestApiPermissionRequestTransferMock,
            )->willReturn($this->representativeCompanyUserRestApiPermissionResponseTransferMock);

        static::assertEquals(
            $this->representativeCompanyUserRestApiPermissionResponseTransferMock,
            $this->stub->hasPermissionToManageOwnRepresentations($this->representativeCompanyUserRestApiPermissionRequestTransferMock),
        );
    }
}
