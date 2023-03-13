<?php

namespace FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business\Model\ErpDeliveryNoteDeleterInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyDeleterErpDeliveryNoteConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business\CompanyDeleterErpDeliveryNoteConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business\Model\ErpDeliveryNoteDeleterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $deleterMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business\CompanyDeleterErpDeliveryNoteConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(CompanyDeleterErpDeliveryNoteConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->deleterMock = $this->getMockBuilder(ErpDeliveryNoteDeleterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyDeleterErpDeliveryNoteConnectorFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testDeleteErpDeliveryNoteDataForCompanyById(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpDeliveryNoteDeleter')
            ->willReturn($this->deleterMock);

        $this->deleterMock->expects(static::atLeastOnce())
            ->method('deleteErpDeliveryNoteDataForCompanyByIdCompany');

        $this->facade->deleteErpDeliveryNoteDataForCompanyById($this->companyTransferMock);
    }
}
