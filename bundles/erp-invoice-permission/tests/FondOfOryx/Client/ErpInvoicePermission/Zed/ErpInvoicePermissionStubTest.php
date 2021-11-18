<?php

namespace FondOfOryx\Client\ErpInvoicePermission\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\ErpInvoicePermission\Dependency\Client\ErpInvoicePermissionToZedRequestInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer;

class ErpInvoicePermissionStubTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpInvoicePermission\Zed\ErpInvoicePermissionStubInterface
     */
    protected $stub;

    /**
     * @var \FondOfOryx\Client\ErpInvoicePermission\Dependency\Client\ErpInvoicePermissionToZedRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer;

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

        $this->zedRequestClientMock = $this->getMockBuilder(ErpInvoicePermissionToZedRequestInterface::class)->disableOriginalConstructor()->getMock();
        $this->erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer = $this->getMockBuilder(ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer::class)->disableOriginalConstructor()->getMock();
        $this->companyBusinessUnitUuidCollectionTransferMock = $this->getMockBuilder(CompanyBusinessUnitUuidCollectionTransfer::class)->disableOriginalConstructor()->getMock();

        $this->stub = new ErpInvoicePermissionStub($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testGetAccessibleCompanyBusinessUnitUuids(): void
    {
        $this->zedRequestClientMock->expects(static::once())
            ->method('call')
            ->with(
                '/erp-invoice-permission/gateway/get-accessible-company-business-unit-uuids',
                $this->erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer,
            )->willReturn($this->companyBusinessUnitUuidCollectionTransferMock);

        $this->stub->getAccessibleCompanyBusinessUnitUuids($this->erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer);
    }
}
