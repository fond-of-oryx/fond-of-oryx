<?php

namespace FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Persistence\CompanyDeleterErpOrderConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class ErpOrderDeleterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Persistence\CompanyDeleterErpOrderConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Business\Model\ErpOrderDeleter
     */
    protected $model;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(CompanyDeleterErpOrderConnectorEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = new ErpOrderDeleter($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testDeleteErpOrderDataForCompanyByIdCompany()
    {
        $this->model->deleteErpOrderDataForCompanyByIdCompany($this->companyTransferMock);
    }
}
