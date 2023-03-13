<?php

namespace FondOfOryx\Zed\CompanyDeleterProductListConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterProductListConnector\Business\Model\CompanyToProductListDeleterInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyDeleterProductListConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterProductListConnector\Business\CompanyDeleterProductListConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterProductListConnector\Business\Model\CompanyToProductListDeleter|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $deleterMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterProductListConnector\Business\CompanyDeleterProductListConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(CompanyDeleterProductListConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->deleterMock = $this->getMockBuilder(CompanyToProductListDeleterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyDeleterProductListConnectorFacade();
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
