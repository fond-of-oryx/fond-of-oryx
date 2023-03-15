<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business\Model\CompanyUserArchiveDeleterInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyDeleterCompanyUserArchiveConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business\CompanyDeleterCompanyUserArchiveConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business\Model\CompanyUserArchiveDeleterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $deleterMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business\CompanyDeleterCompanyUserArchiveConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(CompanyDeleterCompanyUserArchiveConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->deleterMock = $this->getMockBuilder(CompanyUserArchiveDeleterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyDeleterCompanyUserArchiveConnectorFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testDeleteCompanyUserArchiveDataForCompanyByIdCompany(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUserArchiveDeleter')
            ->willReturn($this->deleterMock);

        $this->deleterMock->expects(static::atLeastOnce())
            ->method('deleteCompanyUserArchiveDataForCompanyByIdCompany');

        $this->facade->deleteCompanyUserArchiveDataForCompanyByIdCompany($this->companyTransferMock);
    }
}
