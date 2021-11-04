<?php

namespace FondOfOryx\Zed\CompanyRoleSearchRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence\CompanyRoleSearchRestApiRepository;
use Generated\Shared\Transfer\CompanyRoleListTransfer;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence\CompanyRoleSearchRestApiRepository|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyRoleListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyRoleListTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyRoleSearchRestApi\Communication\Controller\GatewayController
     */
    protected $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanyRoleSearchRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleListTransferMock = $this->getMockBuilder(CompanyRoleListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new GatewayController();
        $this->gatewayController->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testSearchCompanyRoleAction(): void
    {
        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('searchCompanyRoles')
            ->with($this->companyRoleListTransferMock)
            ->willReturn($this->companyRoleListTransferMock);

        static::assertEquals(
            $this->companyRoleListTransferMock,
            $this->gatewayController->searchCompanyRolesAction($this->companyRoleListTransferMock),
        );
    }
}
