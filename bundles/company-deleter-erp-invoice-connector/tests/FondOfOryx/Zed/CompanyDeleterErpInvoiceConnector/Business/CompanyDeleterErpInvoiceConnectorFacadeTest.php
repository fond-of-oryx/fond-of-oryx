<?php

namespace FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business\Model\ErpInvoiceDeleterInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyDeleterErpInvoiceConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business\CompanyDeleterErpInvoiceConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business\Model\ErpInvoiceDeleterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $deleterMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business\CompanyDeleterErpInvoiceConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(CompanyDeleterErpInvoiceConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->deleterMock = $this->getMockBuilder(ErpInvoiceDeleterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyDeleterErpInvoiceConnectorFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testDeleteErpInvoiceDataForCompanyById(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpInvoiceDeleter')
            ->willReturn($this->deleterMock);

        $this->deleterMock->expects(static::atLeastOnce())
            ->method('deleteErpInvoiceDataForCompanyByIdCompany');

        $this->facade->deleteErpInvoiceDataForCompanyById($this->companyTransferMock);
    }
}
