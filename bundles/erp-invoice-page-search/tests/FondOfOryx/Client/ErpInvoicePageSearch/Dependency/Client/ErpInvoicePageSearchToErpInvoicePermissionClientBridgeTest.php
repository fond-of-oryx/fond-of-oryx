<?php

namespace FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client;

use Codeception\Test\Unit;
use FondOfOryx\Client\ErpInvoicePermission\ErpInvoicePermissionClientInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer;

class ErpInvoicePageSearchToErpInvoicePermissionClientBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToErpInvoicePermissionClientBridge
     */
    protected $erpInvoicePageSearchToCompanyUserClientBridge;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyBusinessUnitUuidCollectionTransferMock;

    /**
     * @var \FondOfOryx\Client\ErpInvoicePermission\ErpInvoicePermissionClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $erpInvoicePermissionClientMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpInvoicePermissionCompanyBusinessUnitUuidRequestTransferMock = $this->getMockBuilder(ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitUuidCollectionTransferMock = $this->getMockBuilder(CompanyBusinessUnitUuidCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePermissionClientMock = $this->getMockBuilder(ErpInvoicePermissionClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchToCompanyUserClientBridge = new ErpInvoicePageSearchToErpInvoicePermissionClientBridge(
            $this->erpInvoicePermissionClientMock,
        );
    }

    /**
     * @return void
     */
    public function testGetActiveCompanyUsersByCustomerReference(): void
    {
        $this->erpInvoicePermissionClientMock->expects(static::atLeastOnce())
            ->method('getAccessibleCompanyBusinessUnitUuids')
            ->with($this->erpInvoicePermissionCompanyBusinessUnitUuidRequestTransferMock)
            ->willReturn($this->companyBusinessUnitUuidCollectionTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitUuidCollectionTransferMock,
            $this->erpInvoicePageSearchToCompanyUserClientBridge->getAccessibleCompanyBusinessUnitUuids(
                $this->erpInvoicePermissionCompanyBusinessUnitUuidRequestTransferMock,
            ),
        );
    }
}
