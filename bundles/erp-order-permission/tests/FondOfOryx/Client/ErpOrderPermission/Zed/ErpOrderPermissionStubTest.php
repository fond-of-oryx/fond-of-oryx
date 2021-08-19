<?php

namespace FondOfOryx\Client\ErpOrderPermission\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\ErpOrderPermission\Dependency\Client\ErpOrderPermissionToZedRequestInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer;

class ErpOrderPermissionStubTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpOrderPermission\Zed\ErpOrderPermissionStubInterface
     */
    protected $stub;

    /**
     * @var \FondOfOryx\Client\ErpOrderPermission\Dependency\Client\ErpOrderPermissionToZedRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitUuidCollectionTransferMock;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->zedRequestClientMock = $this->getMockBuilder(ErpOrderPermissionToZedRequestInterface::class)->disableOriginalConstructor()->getMock();
        $this->erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer = $this->getMockBuilder(ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer::class)->disableOriginalConstructor()->getMock();
        $this->companyBusinessUnitUuidCollectionTransferMock = $this->getMockBuilder(CompanyBusinessUnitUuidCollectionTransfer::class)->disableOriginalConstructor()->getMock();

        $this->stub = new ErpOrderPermissionStub($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testGetAccessibleCompanyBusinessUnitUuids(): void
    {
        $this->zedRequestClientMock->expects(static::once())
            ->method('call')
            ->with(
                '/erp-order-permission/gateway/get-accessible-company-business-unit-uuids-action',
                $this->erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer
            )->willReturn($this->companyBusinessUnitUuidCollectionTransferMock);

        $this->stub->getAccessibleCompanyBusinessUnitUuids($this->erpOrderPermissionCompanyBusinessUnitUuidRequestTransfer);
    }
}
