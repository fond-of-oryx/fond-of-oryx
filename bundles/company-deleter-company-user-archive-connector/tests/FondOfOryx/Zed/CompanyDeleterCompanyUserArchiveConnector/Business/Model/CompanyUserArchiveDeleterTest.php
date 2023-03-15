<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Persistence\CompanyDeleterCompanyUserArchiveConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyUserArchiveDeleterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Persistence\CompanyDeleterCompanyUserArchiveConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business\Model\CompanyUserArchiveDeleter
     */
    protected $model;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(CompanyDeleterCompanyUserArchiveConnectorEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = new CompanyUserArchiveDeleter($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testDeleteCompanyUserArchiveDataForCompanyByIdCompany()
    {
        $this->model->deleteCompanyUserArchiveDataForCompanyByIdCompany($this->companyTransferMock);
    }
}
