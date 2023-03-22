<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Business\Model\CompanyRoleDeleterInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyDeleterCompanyRoleConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Business\CompanyDeleterCompanyRoleConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Business\Model\CompanyRoleDeleterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $deleterMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Business\CompanyDeleterCompanyRoleConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(CompanyDeleterCompanyRoleConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->deleterMock = $this->getMockBuilder(CompanyRoleDeleterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyDeleterCompanyRoleConnectorFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testDeleteCompanyRoleDataForCompanyById(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createCompanyRoleDeleter')
            ->willReturn($this->deleterMock);

        $this->deleterMock->expects(static::atLeastOnce())
            ->method('deleteCompanyRoleDataForCompanyByIdCompany');

        $this->facade->deleteCompanyRoleDataForCompanyById($this->companyTransferMock);
    }
}
