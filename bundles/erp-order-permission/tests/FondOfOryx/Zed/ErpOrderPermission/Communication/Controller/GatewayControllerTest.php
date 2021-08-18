<?php

namespace FondOfOryx\Zed\ErpOrderPermission\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrderPermission\Persistence\ErpOrderPermissionRepository;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrderPermission\Communication\Controller\GatewayController
     */
    protected $controller;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPermission\Persistence\ErpOrderPermissionRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitUuidCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderPermissionCompanyBusinessUnitUuidRequestTransferMock;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ErpOrderPermissionRepository::class)->disableOriginalConstructor()->getMock();
        $this->companyBusinessUnitUuidCollectionTransferMock = $this->getMockBuilder(CompanyBusinessUnitUuidCollectionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->erpOrderPermissionCompanyBusinessUnitUuidRequestTransferMock = $this->getMockBuilder(ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer::class)->disableOriginalConstructor()->getMock();

        $this->controller = new GatewayController();
        $this->controller->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testGetAccessibleCompanyBusinessUnitUuidsAction(): void
    {
        $this->repositoryMock->expects(static::once())->method('getAccessibleCompanyBusinessUnitUuidsByPermissionKeyAndCustomerReference')->willReturn($this->companyBusinessUnitUuidCollectionTransferMock);
        $this->erpOrderPermissionCompanyBusinessUnitUuidRequestTransferMock->expects(static::once())->method('getPermissionKey')->willReturn('permissionKey');
        $this->erpOrderPermissionCompanyBusinessUnitUuidRequestTransferMock->expects(static::once())->method('getCustomerReference')->willReturn('customerReference');

        static::assertInstanceOf(CompanyBusinessUnitUuidCollectionTransfer::class, $this->controller->getAccessibleCompanyBusinessUnitUuidsAction($this->erpOrderPermissionCompanyBusinessUnitUuidRequestTransferMock));
    }
}
