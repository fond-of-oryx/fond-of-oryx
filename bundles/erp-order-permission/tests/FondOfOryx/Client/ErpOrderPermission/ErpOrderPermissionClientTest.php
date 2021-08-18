<?php

namespace FondOfOryx\Client\ErpOrderPermission;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Client\ErpOrderPermission\Zed\ErpOrderPermissionStub;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer;

class ErpOrderPermissionClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpOrderPermission\ErpOrderPermissionClientInterface
     */
    protected $client;

    /**
     * @var \FondOfOryx\Client\ErpOrderPermission\ErpOrderPermissionFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Client\ErpOrderPermission\Zed\ErpOrderPermissionStubInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $stubMock;

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

        $this->factoryMock = $this->getMockBuilder(ErpOrderPermissionFactory::class)->disableOriginalConstructor()->getMock();
        $this->stubMock = $this->getMockBuilder(ErpOrderPermissionStub::class)->disableOriginalConstructor()->getMock();
        $this->companyBusinessUnitUuidCollectionTransferMock = $this->getMockBuilder(CompanyBusinessUnitUuidCollectionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->erpOrderPermissionCompanyBusinessUnitUuidRequestTransferMock = $this->getMockBuilder(ErpOrderPermissionCompanyBusinessUnitUuidRequestTransfer::class)->disableOriginalConstructor()->getMock();

        $this->client = new ErpOrderPermissionClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testGetAccessibleCompanyBusinessUnitUuids(): void
    {
        $this->factoryMock->expects(static::once())->method('createErpOrderPermissionStub')->willReturn($this->stubMock);
        $this->stubMock->expects(static::once())->method('getAccessibleCompanyBusinessUnitUuids')->willReturn($this->companyBusinessUnitUuidCollectionTransferMock);

        static::assertInstanceOf(CompanyBusinessUnitUuidCollectionTransfer::class, $this->client->getAccessibleCompanyBusinessUnitUuids($this->erpOrderPermissionCompanyBusinessUnitUuidRequestTransferMock));
    }

    /**
     * @return void
     */
    public function testGetAccessibleCompanyBusinessUnitUuidsThrowsException(): void
    {
        $this->factoryMock->expects(static::once())->method('createErpOrderPermissionStub')->willReturn($this->stubMock);
        $this->stubMock->expects(static::once())->method('getAccessibleCompanyBusinessUnitUuids')->willReturn($this->erpOrderPermissionCompanyBusinessUnitUuidRequestTransferMock);

        $catch = null;
        try {
            $this->client->getAccessibleCompanyBusinessUnitUuids($this->erpOrderPermissionCompanyBusinessUnitUuidRequestTransferMock);
        } catch (Exception $exception) {
            $catch = $exception;
        }

        static::assertNotNull($catch);
    }
}
