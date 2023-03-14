<?php

namespace FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Persistence\CompanyDeleterErpInvoiceConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class ErpInvoiceDeleterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Persistence\CompanyDeleterErpInvoiceConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business\Model\ErpInvoiceDeleter
     */
    protected $model;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(CompanyDeleterErpInvoiceConnectorEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = new ErpInvoiceDeleter($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testDeleteErpInvoiceDataForCompanyByIdCompany()
    {
        $this->model->deleteErpInvoiceDataForCompanyByIdCompany($this->companyTransferMock);
    }
}
