<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Persistence\CompanyDeleterCompanyUnitAddressConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyUnitAddressDeleterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Persistence\CompanyDeleterCompanyUnitAddressConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business\Model\CompanyUnitAddressDeleter
     */
    protected $model;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(CompanyDeleterCompanyUnitAddressConnectorEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = new CompanyUnitAddressDeleter($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testDeleteCompanyUnitAddressDataForCompanyByIdCompany()
    {
        $this->model->deleteCompanyUnitAddressDataForCompanyByIdCompany($this->companyTransferMock);
    }
}
