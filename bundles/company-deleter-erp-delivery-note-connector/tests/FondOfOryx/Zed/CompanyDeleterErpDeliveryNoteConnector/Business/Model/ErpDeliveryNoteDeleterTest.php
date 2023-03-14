<?php

namespace FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Persistence\CompanyDeleterErpDeliveryNoteConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class ErpDeliveryNoteDeleterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Persistence\CompanyDeleterErpDeliveryNoteConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business\Model\ErpDeliveryNoteDeleter
     */
    protected $model;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(CompanyDeleterErpDeliveryNoteConnectorEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = new ErpDeliveryNoteDeleter($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testDeleteErpDeliveryNoteDataForCompanyByIdCompany()
    {
        $this->model->deleteErpDeliveryNoteDataForCompanyByIdCompany($this->companyTransferMock);
    }
}
