<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business\Model\CompanyUnitAddressDeleterInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyDeleterCompanyUnitAddressConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business\CompanyDeleterCompanyUnitAddressConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business\Model\CompanyUnitAddressDeleterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $deleterMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business\CompanyDeleterCompanyUnitAddressConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(CompanyDeleterCompanyUnitAddressConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->deleterMock = $this->getMockBuilder(CompanyUnitAddressDeleterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyDeleterCompanyUnitAddressConnectorFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testDeleteCompanies(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUnitAddressDeleter')
            ->willReturn($this->deleterMock);

        $this->deleterMock->expects(static::atLeastOnce())
            ->method('deleteCompanyUnitAddressDataForCompanyByIdCompany');

        $this->facade->deleteCompanyUnitAddressDataForCompanyById($this->companyTransferMock);
    }
}
