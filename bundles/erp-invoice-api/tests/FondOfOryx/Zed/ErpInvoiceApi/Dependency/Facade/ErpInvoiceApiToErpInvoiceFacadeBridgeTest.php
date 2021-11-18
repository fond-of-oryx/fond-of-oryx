<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceFacadeInterface;
use Generated\Shared\Transfer\ErpInvoiceResponseTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

class ErpInvoiceApiToErpInvoiceFacadeBridgeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToErpInvoiceFacadeBridge
     */
    protected $erpInvoiceApiToErpInvoiceFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->erpInvoiceTransferMock = $this->getMockBuilder(ErpInvoiceTransfer::class)
            ->disableArgumentCloning()
            ->getMock();

        $this->erpInvoiceResponseTransferMock = $this->getMockBuilder(ErpInvoiceResponseTransfer::class)
            ->disableArgumentCloning()
            ->getMock();

        $this->erpInvoiceFacadeMock = $this->getMockBuilder(ErpInvoiceFacadeInterface::class)
            ->disableArgumentCloning()
            ->getMock();

        $this->erpInvoiceApiToErpInvoiceFacadeBridge = new ErpInvoiceApiToErpInvoiceFacadeBridge(
            $this->erpInvoiceFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testCreateErpInvoice(): void
    {
        $this->erpInvoiceFacadeMock->expects(static::atLeastOnce())
            ->method('createErpInvoice')
            ->with($this->erpInvoiceTransferMock)
            ->willReturn($this->erpInvoiceResponseTransferMock);

        static::assertEquals(
            $this->erpInvoiceResponseTransferMock,
            $this->erpInvoiceApiToErpInvoiceFacadeBridge->createErpInvoice($this->erpInvoiceTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateErpInvoice(): void
    {
        $this->erpInvoiceFacadeMock->expects(static::atLeastOnce())
            ->method('updateErpInvoice')
            ->with($this->erpInvoiceTransferMock)
            ->willReturn($this->erpInvoiceResponseTransferMock);

        static::assertEquals(
            $this->erpInvoiceResponseTransferMock,
            $this->erpInvoiceApiToErpInvoiceFacadeBridge->updateErpInvoice($this->erpInvoiceTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testDeleteErpInvoiceByIdErpInvoice(): void
    {
        $idErpInvoice = 1;

        $this->erpInvoiceFacadeMock->expects(static::atLeastOnce())
            ->method('deleteErpInvoiceByIdErpInvoice')
            ->with($idErpInvoice);

        $this->erpInvoiceApiToErpInvoiceFacadeBridge->deleteErpInvoiceByIdErpInvoice($idErpInvoice);
    }

    /**
     * @return void
     */
    public function testFindErpInvoiceByIdErpInvoice(): void
    {
        $idErpInvoice = 1;

        $this->erpInvoiceFacadeMock->expects(static::atLeastOnce())
            ->method('findErpInvoiceByIdErpInvoice')
            ->with($idErpInvoice)
            ->willReturn($this->erpInvoiceTransferMock);

        static::assertEquals(
            $this->erpInvoiceTransferMock,
            $this->erpInvoiceApiToErpInvoiceFacadeBridge->findErpInvoiceByIdErpInvoice($idErpInvoice),
        );
    }
}
