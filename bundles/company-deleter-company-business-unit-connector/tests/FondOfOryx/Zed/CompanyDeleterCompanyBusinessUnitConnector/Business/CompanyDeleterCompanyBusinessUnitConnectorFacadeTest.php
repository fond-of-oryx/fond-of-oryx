<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business\Model\BusinessUnitDeleterInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyDeleterCompanyBusinessUnitConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business\CompanyDeleterCompanyBusinessUnitConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business\Model\BusinessUnitDeleterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $deleterMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business\CompanyDeleterCompanyBusinessUnitConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(CompanyDeleterCompanyBusinessUnitConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->deleterMock = $this->getMockBuilder(BusinessUnitDeleterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyDeleterCompanyBusinessUnitConnectorFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testDeleteCompanies(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createBusinessUnitDeleter')
            ->willReturn($this->deleterMock);

        $this->deleterMock->expects(static::atLeastOnce())
            ->method('deleteBusinessUnitDataForCompanyByIdCompany');

        $this->facade->deleteCompanyBusinessUnitDataForCompanyById($this->companyTransferMock);
    }
}
