<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitSearchRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitSearchRestApi\Persistence\CompanyBusinessUnitSearchRestApiRepository;
use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitSearchRestApi\Persistence\CompanyBusinessUnitSearchRestApiRepository|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyBusinessUnitListTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitSearchRestApi\Communication\Controller\GatewayController
     */
    protected $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanyBusinessUnitSearchRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitListTransferMock = $this->getMockBuilder(CompanyBusinessUnitListTransfer::class)
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
            ->method('searchCompanyBusinessUnit')
            ->with($this->companyBusinessUnitListTransferMock)
            ->willReturn($this->companyBusinessUnitListTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitListTransferMock,
            $this->gatewayController->searchCompanyBusinessUnitAction($this->companyBusinessUnitListTransferMock),
        );
    }
}
