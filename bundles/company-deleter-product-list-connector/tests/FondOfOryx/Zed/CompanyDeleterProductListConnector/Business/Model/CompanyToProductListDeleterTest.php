<?php

namespace FondOfOryx\Zed\CompanyDeleterProductListConnector\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterProductListConnector\Persistence\CompanyDeleterProductListConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyToProductListDeleterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterProductListConnector\Persistence\CompanyDeleterProductListConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterProductListConnector\Business\Model\CompanyToProductListDeleter
     */
    protected $model;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(CompanyDeleterProductListConnectorEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = new CompanyToProductListDeleter($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testDeleteProductListDataForCompanyByIdCompany()
    {
        $this->model->deleteProductListDataForCompanyByIdCompany($this->companyTransferMock);
    }
}
