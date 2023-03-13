<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Persistence\CompanyDeleterCompanyRoleConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyRoleDeleterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Persistence\CompanyDeleterCompanyRoleConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Business\Model\CompanyRoleDeleter
     */
    protected $model;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(CompanyDeleterCompanyRoleConnectorEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = new CompanyRoleDeleter($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testDeleteCompanyRoleDataForCompanyByIdCompany()
    {
        $this->model->deleteCompanyRoleDataForCompanyByIdCompany($this->companyTransferMock);
    }
}
