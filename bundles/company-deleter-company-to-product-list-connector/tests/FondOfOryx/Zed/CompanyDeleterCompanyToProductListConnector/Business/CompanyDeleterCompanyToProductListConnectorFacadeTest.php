<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Business\Model\CompanyToProductListDeleterInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyDeleterCompanyToProductListConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Business\CompanyDeleterCompanyToProductListConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Business\Model\CompanyToProductListDeleter|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $deleterMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Business\CompanyDeleterCompanyToProductListConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(CompanyDeleterCompanyToProductListConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->deleterMock = $this->getMockBuilder(CompanyToProductListDeleterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyDeleterCompanyToProductListConnectorFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testDeleteProductListDataForCompanyById(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createCompanyToProductListDeleter')
            ->willReturn($this->deleterMock);

        $this->deleterMock->expects(static::atLeastOnce())
            ->method('deleteProductListDataForCompanyByIdCompany');

        $this->facade->deleteProductListDataForCompanyById($this->companyTransferMock);
    }
}
