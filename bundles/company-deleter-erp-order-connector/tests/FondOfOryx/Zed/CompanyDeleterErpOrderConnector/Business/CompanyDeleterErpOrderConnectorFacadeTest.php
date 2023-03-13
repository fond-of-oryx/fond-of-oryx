<?php

namespace FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Business\Model\ErpOrderDeleterInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyDeleterErpOrderConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Business\CompanyDeleterErpOrderConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Business\Model\ErpOrderDeleterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $deleterMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Business\CompanyDeleterErpOrderConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(CompanyDeleterErpOrderConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->deleterMock = $this->getMockBuilder(ErpOrderDeleterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyDeleterErpOrderConnectorFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testDeleteErpOrderDataForCompanyById(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpOrderDeleter')
            ->willReturn($this->deleterMock);

        $this->deleterMock->expects(static::atLeastOnce())
            ->method('deleteErpOrderDataForCompanyByIdCompany');

        $this->facade->deleteErpOrderDataForCompanyById($this->companyTransferMock);
    }
}
