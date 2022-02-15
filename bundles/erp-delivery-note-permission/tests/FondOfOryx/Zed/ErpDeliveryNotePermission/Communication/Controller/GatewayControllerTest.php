<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePermission\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNotePermission\Persistence\ErpDeliveryNotePermissionRepository;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePermission\Communication\Controller\GatewayController
     */
    protected $controller;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePermission\Persistence\ErpDeliveryNotePermissionRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitUuidCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransferMock;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ErpDeliveryNotePermissionRepository::class)->disableOriginalConstructor()->getMock();
        $this->companyBusinessUnitUuidCollectionTransferMock = $this->getMockBuilder(CompanyBusinessUnitUuidCollectionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransferMock = $this->getMockBuilder(ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer::class)->disableOriginalConstructor()->getMock();

        $this->controller = new GatewayController();
        $this->controller->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testGetAccessibleCompanyBusinessUnitUuidsAction(): void
    {
        $this->repositoryMock->expects(static::once())->method('getAccessibleCompanyBusinessUnitUuidsByPermissionKeyAndCustomerReference')->willReturn($this->companyBusinessUnitUuidCollectionTransferMock);
        $this->erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransferMock->expects(static::once())->method('getPermissionKey')->willReturn('permissionKey');
        $this->erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransferMock->expects(static::once())->method('getCustomerReference')->willReturn('customerReference');

        static::assertInstanceOf(CompanyBusinessUnitUuidCollectionTransfer::class, $this->controller->getAccessibleCompanyBusinessUnitUuidsAction($this->erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransferMock));
    }
}
