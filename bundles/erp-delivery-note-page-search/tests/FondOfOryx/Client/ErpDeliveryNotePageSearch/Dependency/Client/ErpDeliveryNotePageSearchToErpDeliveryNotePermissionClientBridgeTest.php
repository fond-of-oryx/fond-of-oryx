<?php

namespace FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client;

use Codeception\Test\Unit;
use FondOfOryx\Client\ErpDeliveryNotePermission\ErpDeliveryNotePermissionClientInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer;

class ErpDeliveryNotePageSearchToErpDeliveryNotePermissionClientBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToErpDeliveryNotePermissionClientBridge
     */
    protected $erpDeliveryNotePageSearchToCompanyUserClientBridge;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyBusinessUnitUuidCollectionTransferMock;

    /**
     * @var \FondOfOryx\Client\ErpDeliveryNotePermission\ErpDeliveryNotePermissionClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $erpDeliveryNotePermissionClientMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransferMock = $this->getMockBuilder(ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitUuidCollectionTransferMock = $this->getMockBuilder(CompanyBusinessUnitUuidCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePermissionClientMock = $this->getMockBuilder(ErpDeliveryNotePermissionClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchToCompanyUserClientBridge = new ErpDeliveryNotePageSearchToErpDeliveryNotePermissionClientBridge(
            $this->erpDeliveryNotePermissionClientMock,
        );
    }

    /**
     * @return void
     */
    public function testGetActiveCompanyUsersByCustomerReference(): void
    {
        $this->erpDeliveryNotePermissionClientMock->expects(static::atLeastOnce())
            ->method('getAccessibleCompanyBusinessUnitUuids')
            ->with($this->erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransferMock)
            ->willReturn($this->companyBusinessUnitUuidCollectionTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitUuidCollectionTransferMock,
            $this->erpDeliveryNotePageSearchToCompanyUserClientBridge->getAccessibleCompanyBusinessUnitUuids(
                $this->erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransferMock,
            ),
        );
    }
}
