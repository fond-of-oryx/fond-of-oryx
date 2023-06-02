<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiPermissionToZedRequestInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionResponseTransfer;

class RepresentativeCompanyUserTradeFairRestApiPermissionStubTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer $representativeCompanyUserTradeFairRestApiPermissionRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiPermissionResponseTransfer $representativeCompanyUserTradeFairRestApiPermissionResponseTransferMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiPermissionToZedRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiPermissionToZedRequestInterface $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\Zed\RepresentativeCompanyUserTradeFairRestApiPermissionStub
     */
    protected RepresentativeCompanyUserTradeFairRestApiPermissionStub $stub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->representativeCompanyUserTradeFairRestApiPermissionRequestTransferMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairRestApiPermissionResponseTransferMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiPermissionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiPermissionToZedRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stub = new RepresentativeCompanyUserTradeFairRestApiPermissionStub($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testHasPermissionToManageOwnTradeFairRepresentations(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                '/representative-company-user-trade-fair-rest-api-permission/gateway/has-permission-to-manage-trade-fair-representations',
                $this->representativeCompanyUserTradeFairRestApiPermissionRequestTransferMock,
            )->willReturn($this->representativeCompanyUserTradeFairRestApiPermissionResponseTransferMock);

        static::assertEquals(
            $this->representativeCompanyUserTradeFairRestApiPermissionResponseTransferMock,
            $this->stub->hasPermissionToManageOwnTradeFairRepresentations(
                $this->representativeCompanyUserTradeFairRestApiPermissionRequestTransferMock
            ),
        );
    }
}
