<?php

namespace FondOfOryx\Zed\ErpOrderApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrder\Business\ErpOrderFacadeInterface;
use Generated\Shared\Transfer\ErpOrderResponseTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

class ErpOrderApiToErpOrderFacadeBridgeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ErpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\ErpOrderFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToErpOrderFacadeBridge
     */
    protected $erpOrderApiToErpOrderFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->erpOrderTransferMock = $this->getMockBuilder(ErpOrderTransfer::class)
            ->disableArgumentCloning()
            ->getMock();

        $this->erpOrderResponseTransferMock = $this->getMockBuilder(ErpOrderResponseTransfer::class)
            ->disableArgumentCloning()
            ->getMock();

        $this->erpOrderFacadeMock = $this->getMockBuilder(ErpOrderFacadeInterface::class)
            ->disableArgumentCloning()
            ->getMock();

        $this->erpOrderApiToErpOrderFacadeBridge = new ErpOrderApiToErpOrderFacadeBridge(
            $this->erpOrderFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testCreateErpOrder(): void
    {
        $this->erpOrderFacadeMock->expects(static::atLeastOnce())
            ->method('createErpOrder')
            ->with($this->erpOrderTransferMock)
            ->willReturn($this->erpOrderResponseTransferMock);

        static::assertEquals(
            $this->erpOrderResponseTransferMock,
            $this->erpOrderApiToErpOrderFacadeBridge->createErpOrder($this->erpOrderTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateErpOrder(): void
    {
        $this->erpOrderFacadeMock->expects(static::atLeastOnce())
            ->method('updateErpOrder')
            ->with($this->erpOrderTransferMock)
            ->willReturn($this->erpOrderResponseTransferMock);

        static::assertEquals(
            $this->erpOrderResponseTransferMock,
            $this->erpOrderApiToErpOrderFacadeBridge->updateErpOrder($this->erpOrderTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testDeleteErpOrderByIdErpOrder(): void
    {
        $idErpOrder = 1;

        $this->erpOrderFacadeMock->expects(static::atLeastOnce())
            ->method('deleteErpOrderByIdErpOrder')
            ->with($idErpOrder);

        $this->erpOrderApiToErpOrderFacadeBridge->deleteErpOrderByIdErpOrder($idErpOrder);
    }

    /**
     * @return void
     */
    public function testFindErpOrderByIdErpOrder(): void
    {
        $idErpOrder = 1;

        $this->erpOrderFacadeMock->expects(static::atLeastOnce())
            ->method('findErpOrderByIdErpOrder')
            ->with($idErpOrder)
            ->willReturn($this->erpOrderTransferMock);

        static::assertEquals(
            $this->erpOrderTransferMock,
            $this->erpOrderApiToErpOrderFacadeBridge->findErpOrderByIdErpOrder($idErpOrder),
        );
    }
}
