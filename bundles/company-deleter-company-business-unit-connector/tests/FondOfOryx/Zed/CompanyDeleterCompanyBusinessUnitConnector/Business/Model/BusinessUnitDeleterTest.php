<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Persistence\CompanyDeleterCompanyBusinessUnitConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class BusinessUnitDeleterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Persistence\CompanyDeleterCompanyBusinessUnitConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business\Model\BusinessUnitDeleter
     */
    protected $model;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(CompanyDeleterCompanyBusinessUnitConnectorEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = new BusinessUnitDeleter($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testDeleteBusinessUnitDataForCompanyByIdCompany()
    {
        $this->model->deleteBusinessUnitDataForCompanyByIdCompany($this->companyTransferMock);
    }
}
