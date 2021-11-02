<?php

namespace FondOfOryx\Zed\CompanySearchRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanySearchRestApi\Persistence\CompanySearchRestApiRepository;
use Generated\Shared\Transfer\CompanyListTransfer;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanySearchRestApi\Persistence\CompanySearchRestApiRepository|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyListTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanySearchRestApi\Communication\Controller\GatewayController
     */
    protected $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanySearchRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyListTransferMock = $this->getMockBuilder(CompanyListTransfer::class)
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
            ->method('searchCompanies')
            ->with($this->companyListTransferMock)
            ->willReturn($this->companyListTransferMock);

        static::assertEquals(
            $this->companyListTransferMock,
            $this->gatewayController->searchCompaniesAction($this->companyListTransferMock),
        );
    }
}
