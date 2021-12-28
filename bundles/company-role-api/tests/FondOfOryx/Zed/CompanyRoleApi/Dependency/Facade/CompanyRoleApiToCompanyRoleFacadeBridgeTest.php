<?php

namespace FondOfOryx\Zed\CompanyRoleApi\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyResponseTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Spryker\Zed\CompanyRole\Business\CompanyRoleFacade;

class CompanyRoleApiToCompanyRoleFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyRoleApi\Dependency\Facade\CompanyRoleApiToCompanyRoleFacadeBridge
     */
    protected $companyRoleApiToCompanyRoleFacadeBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\CompanyRole\Business\CompanyRoleFacade
     */
    protected $companyRoleFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyRoleTransfer
     */
    protected $companyRoleTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyResponseTransfer
     */
    protected $companyResponseTransferMock;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->companyRoleTransferMock = $this->getMockBuilder(CompanyRoleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleFacadeMock = $this->getMockBuilder(CompanyRoleFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyResponseTransferMock = $this->getMockBuilder(CompanyResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleApiToCompanyRoleFacadeBridge = new CompanyRoleApiToCompanyRoleFacadeBridge(
            $this->companyRoleFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetCompanyRoleById(): void
    {
        $this->companyRoleFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyRoleById')
            ->with($this->companyRoleTransferMock)
            ->willReturn($this->companyRoleTransferMock);

        static::assertEquals(
            $this->companyRoleTransferMock,
            $this->companyRoleApiToCompanyRoleFacadeBridge->getCompanyRoleById($this->companyRoleTransferMock),
        );
    }
}
