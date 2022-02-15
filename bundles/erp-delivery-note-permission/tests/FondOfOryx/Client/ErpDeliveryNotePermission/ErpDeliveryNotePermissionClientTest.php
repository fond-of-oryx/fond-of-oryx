<?php

namespace FondOfOryx\Client\ErpDeliveryNotePermission;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Client\ErpDeliveryNotePermission\Zed\ErpDeliveryNotePermissionStub;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer;

class ErpDeliveryNotePermissionClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpDeliveryNotePermission\ErpDeliveryNotePermissionClientInterface
     */
    protected $client;

    /**
     * @var \FondOfOryx\Client\ErpDeliveryNotePermission\ErpDeliveryNotePermissionFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Client\ErpDeliveryNotePermission\Zed\ErpDeliveryNotePermissionStubInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $stubMock;

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

        $this->factoryMock = $this->getMockBuilder(ErpDeliveryNotePermissionFactory::class)->disableOriginalConstructor()->getMock();
        $this->stubMock = $this->getMockBuilder(ErpDeliveryNotePermissionStub::class)->disableOriginalConstructor()->getMock();
        $this->companyBusinessUnitUuidCollectionTransferMock = $this->getMockBuilder(CompanyBusinessUnitUuidCollectionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransferMock = $this->getMockBuilder(ErpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransfer::class)->disableOriginalConstructor()->getMock();

        $this->client = new ErpDeliveryNotePermissionClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testGetAccessibleCompanyBusinessUnitUuids(): void
    {
        $this->factoryMock->expects(static::once())->method('createErpDeliveryNotePermissionStub')->willReturn($this->stubMock);
        $this->stubMock->expects(static::once())->method('getAccessibleCompanyBusinessUnitUuids')->willReturn($this->companyBusinessUnitUuidCollectionTransferMock);

        static::assertInstanceOf(CompanyBusinessUnitUuidCollectionTransfer::class, $this->client->getAccessibleCompanyBusinessUnitUuids($this->erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransferMock));
    }

    /**
     * @return void
     */
    public function testGetAccessibleCompanyBusinessUnitUuidsThrowsException(): void
    {
        $this->factoryMock->expects(static::once())->method('createErpDeliveryNotePermissionStub')->willReturn($this->stubMock);
        $this->stubMock->expects(static::once())->method('getAccessibleCompanyBusinessUnitUuids')->willReturn($this->erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransferMock);

        $catch = null;
        try {
            $this->client->getAccessibleCompanyBusinessUnitUuids($this->erpDeliveryNotePermissionCompanyBusinessUnitUuidRequestTransferMock);
        } catch (Exception $exception) {
            $catch = $exception;
        }

        static::assertNotNull($catch);
    }
}
