<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client;

use Codeception\Test\Unit;
use FondOfOryx\Client\ErpOrderPermission\ErpOrderPermissionClientInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer;

class ErpOrderPageSearchToErpOrderPermissionClientBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToErpOrderPermissionClientBridge
     */
    protected $erpOrderPageSearchToCompanyUserClientBridge;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderPermissionCompanyBusinessUnitUuidRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitUuidCollectionTransferMock;

    /**
     * @var \FondOfOryx\Client\ErpOrderPermission\ErpOrderPermissionClientInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderPermissionClientMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpOrderPermissionCompanyBusinessUnitUuidRequestTransferMock = $this->getMockBuilder(ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitUuidCollectionTransferMock = $this->getMockBuilder(CompanyBusinessUnitUuidCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPermissionClientMock = $this->getMockBuilder(ErpOrderPermissionClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchToCompanyUserClientBridge = new ErpOrderPageSearchToErpOrderPermissionClientBridge(
            $this->erpOrderPermissionClientMock
        );
    }

    /**
     * @return void
     */
    public function testGetActiveCompanyUsersByCustomerReference(): void
    {
        $this->erpOrderPermissionClientMock->expects(static::atLeastOnce())
            ->method('getAccessibleCompanyBusinessUnitUuids')
            ->with($this->erpOrderPermissionCompanyBusinessUnitUuidRequestTransferMock)
            ->willReturn($this->companyBusinessUnitUuidCollectionTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitUuidCollectionTransferMock,
            $this->erpOrderPageSearchToCompanyUserClientBridge->getAccessibleCompanyBusinessUnitUuids(
                $this->erpOrderPermissionCompanyBusinessUnitUuidRequestTransferMock
            )
        );
    }
}
