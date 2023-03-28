<?php

namespace FondOfOryx\Client\CompaniesRestApiPermission\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompaniesRestApiPermission\Dependency\Client\CompaniesRestApiPermissionToZedRequestInterface;
use Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer;
use Generated\Shared\Transfer\CompaniesRestApiPermissionResponseTransfer;

class CompaniesRestApiPermissionStubTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companiesRestApiPermissionRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompaniesRestApiPermissionResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companiesRestApiPermissionResponseTransferMock;

    /**
     * @var \FondOfOryx\Client\CompaniesRestApiPermission\Dependency\Client\CompaniesRestApiPermissionToZedRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\CompaniesRestApiPermission\Zed\CompaniesRestApiPermissionStub
     */
    protected $stub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companiesRestApiPermissionRequestTransferMock = $this->getMockBuilder(CompaniesRestApiPermissionRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesRestApiPermissionResponseTransferMock = $this->getMockBuilder(CompaniesRestApiPermissionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(CompaniesRestApiPermissionToZedRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stub = new CompaniesRestApiPermissionStub($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testHasPermissionToDeleteCompany(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                '/companies-rest-api-permission/gateway/has-permission-to-delete-company',
                $this->companiesRestApiPermissionRequestTransferMock,
            )->willReturn($this->companiesRestApiPermissionResponseTransferMock);

        static::assertEquals(
            $this->companiesRestApiPermissionResponseTransferMock,
            $this->stub->hasPermissionToDeleteCompany($this->companiesRestApiPermissionRequestTransferMock),
        );
    }
}
