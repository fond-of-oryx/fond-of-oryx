<?php

namespace FondOfOryx\Zed\CompanyTypeConverter\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyTypeRole\Business\CompanyTypeRoleFacadeInterface;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyTypeTransfer;

class CompanyTypeConverterToCompanyTypeRoleFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyTypeRole\Business\CompanyTypeRoleFacadeInterface
     */
    protected $companyTypeRoleFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTypeTransfer
     */
    protected $companyTypeTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyRoleTransfer
     */
    protected $companyRoleTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyTypeRoleFacadeBridge
     */
    protected $companyTypeConverterToCompanyTypeRoleFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyTypeRoleFacadeMock = $this->getMockBuilder(CompanyTypeRoleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTypeTransferMock = $this->getMockBuilder(CompanyTypeTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleTransferMock = $this->getMockBuilder(CompanyRoleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTypeConverterToCompanyTypeRoleFacadeBridge = new CompanyTypeConverterToCompanyTypeRoleFacadeBridge(
            $this->companyTypeRoleFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetPermissionKeysByCompanyTypeAndCompanyRole(): void
    {
        $permissionKeys = [
            'key1',
            'key2',
        ];

        $this->companyTypeRoleFacadeMock->expects($this->atLeastOnce())
            ->method('getPermissionKeysByCompanyTypeAndCompanyRole')
            ->with($this->companyTypeTransferMock, $this->companyRoleTransferMock)
            ->willReturn($permissionKeys);

        $permissionKeysResult = $this->companyTypeConverterToCompanyTypeRoleFacadeBridge
            ->getPermissionKeysByCompanyTypeAndCompanyRole(
                $this->companyTypeTransferMock,
                $this->companyRoleTransferMock,
            );

        $this->assertNotEmpty($permissionKeysResult);
        $this->assertEquals($permissionKeys, $permissionKeysResult);
        $this->assertTrue(is_array($permissionKeysResult));
    }
}
