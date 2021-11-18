<?php

namespace FondOfOryx\Zed\ErpInvoicePermission\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoicePermission\Persistence\ErpInvoicePermissionRepository;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoicePermission\Communication\Controller\GatewayController
     */
    protected $controller;

    /**
     * @var \FondOfOryx\Zed\ErpInvoicePermission\Persistence\ErpInvoicePermissionRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitUuidCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransferMock;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ErpInvoicePermissionRepository::class)->disableOriginalConstructor()->getMock();
        $this->companyBusinessUnitUuidCollectionTransferMock = $this->getMockBuilder(CompanyBusinessUnitUuidCollectionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->erpInvoicePermissionCompanyBusinessUnitUuidRequestTransferMock = $this->getMockBuilder(ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer::class)->disableOriginalConstructor()->getMock();

        $this->controller = new GatewayController();
        $this->controller->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testGetAccessibleCompanyBusinessUnitUuidsAction(): void
    {
        $this->repositoryMock->expects(static::once())->method('getAccessibleCompanyBusinessUnitUuidsByPermissionKeyAndCustomerReference')->willReturn($this->companyBusinessUnitUuidCollectionTransferMock);
        $this->erpInvoicePermissionCompanyBusinessUnitUuidRequestTransferMock->expects(static::once())->method('getPermissionKey')->willReturn('permissionKey');
        $this->erpInvoicePermissionCompanyBusinessUnitUuidRequestTransferMock->expects(static::once())->method('getCustomerReference')->willReturn('customerReference');

        static::assertInstanceOf(CompanyBusinessUnitUuidCollectionTransfer::class, $this->controller->getAccessibleCompanyBusinessUnitUuidsAction($this->erpInvoicePermissionCompanyBusinessUnitUuidRequestTransferMock));
    }
}
