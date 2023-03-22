<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Persistence\CompanyDeleterCompanyUserConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyUserDeleterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Persistence\CompanyDeleterCompanyUserConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Business\Model\CompanyUserDeleter
     */
    protected $model;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(CompanyDeleterCompanyUserConnectorEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = new CompanyUserDeleter($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testDeleteCompanyUserDataForCompanyByIdCompany()
    {
        $this->model->deleteCompanyUserDataForCompanyByIdCompany($this->companyTransferMock);
    }
}
