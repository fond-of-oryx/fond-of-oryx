<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitAddressSearchRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitAddressSearchRestApi\Persistence\CompanyBusinessUnitAddressSearchRestApiRepository;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitAddressSearchRestApi\Persistence\CompanyBusinessUnitAddressSearchRestApiRepository|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitAddressListTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitAddressSearchRestApi\Communication\Controller\GatewayController
     */
    protected $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanyBusinessUnitAddressSearchRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitAddressListTransferMock = $this->getMockBuilder(CompanyBusinessUnitAddressListTransfer::class)
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
            ->method('searchCompanyBusinessUnitAddress')
            ->with($this->companyBusinessUnitAddressListTransferMock)
            ->willReturn($this->companyBusinessUnitAddressListTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitAddressListTransferMock,
            $this->gatewayController->searchCompanyBusinessUnitAddressAction($this->companyBusinessUnitAddressListTransferMock)
        );
    }
}
