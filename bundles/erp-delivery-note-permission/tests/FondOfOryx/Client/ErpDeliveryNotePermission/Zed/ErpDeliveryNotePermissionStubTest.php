<?php

namespace FondOfOryx\Client\ErpDeliveryNotePermission\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\ErpDeliveryNotePermission\Dependency\Client\ErpDeliveryNotePermissionToZedRequestInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer;

class ErpDeliveryNotePermissionStubTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpDeliveryNotePermission\Zed\ErpDeliveryNotePermissionStubInterface
     */
    protected $stub;

    /**
     * @var \FondOfOryx\Client\ErpDeliveryNotePermission\Dependency\Client\ErpDeliveryNotePermissionToZedRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer;

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

        $this->zedRequestClientMock = $this->getMockBuilder(ErpDeliveryNotePermissionToZedRequestInterface::class)->disableOriginalConstructor()->getMock();
        $this->erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer = $this->getMockBuilder(ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer::class)->disableOriginalConstructor()->getMock();
        $this->companyBusinessUnitUuidCollectionTransferMock = $this->getMockBuilder(CompanyBusinessUnitUuidCollectionTransfer::class)->disableOriginalConstructor()->getMock();

        $this->stub = new ErpDeliveryNotePermissionStub($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testGetAccessibleCompanyBusinessUnitUuids(): void
    {
        $this->zedRequestClientMock->expects(static::once())
            ->method('call')
            ->with(
                '/erp-delivery-note-permission/gateway/get-accessible-company-business-unit-uuids',
                $this->erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer,
            )->willReturn($this->companyBusinessUnitUuidCollectionTransferMock);

        $this->stub->getAccessibleCompanyBusinessUnitUuids($this->erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer);
    }
}
