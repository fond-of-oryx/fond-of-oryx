<?php

namespace FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyRoleResponseTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Spryker\Zed\CompanyRole\Business\CompanyRoleFacadeInterface;

class CompanyUserCompanyRoleConnectorToCompanyRoleFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\CompanyRole\Business\CompanyRoleFacadeInterface
     */
    protected $companyRoleFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyRoleResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyRoleResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyRoleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyRoleTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade\CompanyUserCompanyRoleConnectorToCompanyRoleFacadeBridge
     */
    protected $companyUserCompanyRoleConnectorToCompanyRoleFacadeBridge;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyRoleFacadeMock = $this->getMockBuilder(CompanyRoleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleTransferMock = $this->getMockBuilder(CompanyRoleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleResponseTransferMock = $this->getMockBuilder(CompanyRoleResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCompanyRoleConnectorToCompanyRoleFacadeBridge =
            new CompanyUserCompanyRoleConnectorToCompanyRoleFacadeBridge($this->companyRoleFacadeMock);
    }

    /**
     * @return void
     */
    public function testFindCompanyRoleByUuid(): void
    {
        $this->companyRoleFacadeMock->expects(static::atLeastOnce())
            ->method('findCompanyRoleByUuid')
            ->with($this->companyRoleTransferMock)
            ->willReturn($this->companyRoleResponseTransferMock);

        static::assertInstanceOf(
            CompanyRoleResponseTransfer::class,
            $this->companyUserCompanyRoleConnectorToCompanyRoleFacadeBridge->findCompanyRoleByUuid($this->companyRoleTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testSaveCompanyUser(): void
    {
        $this->companyRoleFacadeMock->expects(static::atLeastOnce())
            ->method('saveCompanyUser')
            ->with($this->companyUserTransferMock);

        $this->companyUserCompanyRoleConnectorToCompanyRoleFacadeBridge
            ->saveCompanyUser($this->companyUserTransferMock);
    }
}
