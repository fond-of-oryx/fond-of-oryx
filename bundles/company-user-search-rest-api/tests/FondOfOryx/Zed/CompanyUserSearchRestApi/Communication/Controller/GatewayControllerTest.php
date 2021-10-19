<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\CompanyUserSearchRestApiRepository;
use Generated\Shared\Transfer\CompanyUserListTransfer;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\CompanyUserSearchRestApiRepository|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserListTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserListTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserSearchRestApi\Communication\Controller\GatewayController
     */
    protected $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanyUserSearchRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserListTransferMock = $this->getMockBuilder(CompanyUserListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new GatewayController();
        $this->gatewayController->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testSearchCompaniesAction(): void
    {
        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('searchCompanyUser')
            ->with($this->companyUserListTransferMock)
            ->willReturn($this->companyUserListTransferMock);

        static::assertEquals(
            $this->companyUserListTransferMock,
            $this->gatewayController->searchCompanyUserAction($this->companyUserListTransferMock)
        );
    }
}
