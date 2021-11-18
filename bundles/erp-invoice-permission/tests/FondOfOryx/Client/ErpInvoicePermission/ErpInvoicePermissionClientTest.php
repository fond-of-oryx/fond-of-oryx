<?php

namespace FondOfOryx\Client\ErpInvoicePermission;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Client\ErpInvoicePermission\Zed\ErpInvoicePermissionStub;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer;

class ErpInvoicePermissionClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpInvoicePermission\ErpInvoicePermissionClientInterface
     */
    protected $client;

    /**
     * @var \FondOfOryx\Client\ErpInvoicePermission\ErpInvoicePermissionFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Client\ErpInvoicePermission\Zed\ErpInvoicePermissionStubInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $stubMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitUuidCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransferMock;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(ErpInvoicePermissionFactory::class)->disableOriginalConstructor()->getMock();
        $this->stubMock = $this->getMockBuilder(ErpInvoicePermissionStub::class)->disableOriginalConstructor()->getMock();
        $this->companyBusinessUnitUuidCollectionTransferMock = $this->getMockBuilder(CompanyBusinessUnitUuidCollectionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->erpInvoicePermissionCompanyBusinessUnitUuidRequestTransferMock = $this->getMockBuilder(ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer::class)->disableOriginalConstructor()->getMock();

        $this->client = new ErpInvoicePermissionClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testGetAccessibleCompanyBusinessUnitUuids(): void
    {
        $this->factoryMock->expects(static::once())->method('createErpInvoicePermissionStub')->willReturn($this->stubMock);
        $this->stubMock->expects(static::once())->method('getAccessibleCompanyBusinessUnitUuids')->willReturn($this->companyBusinessUnitUuidCollectionTransferMock);

        static::assertInstanceOf(CompanyBusinessUnitUuidCollectionTransfer::class, $this->client->getAccessibleCompanyBusinessUnitUuids($this->erpInvoicePermissionCompanyBusinessUnitUuidRequestTransferMock));
    }

    /**
     * @return void
     */
    public function testGetAccessibleCompanyBusinessUnitUuidsThrowsException(): void
    {
        $this->factoryMock->expects(static::once())->method('createErpInvoicePermissionStub')->willReturn($this->stubMock);
        $this->stubMock->expects(static::once())->method('getAccessibleCompanyBusinessUnitUuids')->willReturn($this->erpInvoicePermissionCompanyBusinessUnitUuidRequestTransferMock);

        $catch = null;
        try {
            $this->client->getAccessibleCompanyBusinessUnitUuids($this->erpInvoicePermissionCompanyBusinessUnitUuidRequestTransferMock);
        } catch (Exception $exception) {
            $catch = $exception;
        }

        static::assertNotNull($catch);
    }
}
