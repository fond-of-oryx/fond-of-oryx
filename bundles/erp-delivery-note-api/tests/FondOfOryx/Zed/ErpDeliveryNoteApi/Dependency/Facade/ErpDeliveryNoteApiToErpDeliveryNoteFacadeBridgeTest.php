<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNote\Business\ErpDeliveryNoteFacadeInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

class ErpDeliveryNoteApiToErpDeliveryNoteFacadeBridgeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\ErpDeliveryNoteFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade\ErpDeliveryNoteApiToErpDeliveryNoteFacadeBridge
     */
    protected $erpDeliveryNoteApiToErpDeliveryNoteFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->erpDeliveryNoteTransferMock = $this->getMockBuilder(ErpDeliveryNoteTransfer::class)
            ->disableArgumentCloning()
            ->getMock();

        $this->erpDeliveryNoteResponseTransferMock = $this->getMockBuilder(ErpDeliveryNoteResponseTransfer::class)
            ->disableArgumentCloning()
            ->getMock();

        $this->erpDeliveryNoteFacadeMock = $this->getMockBuilder(ErpDeliveryNoteFacadeInterface::class)
            ->disableArgumentCloning()
            ->getMock();

        $this->erpDeliveryNoteApiToErpDeliveryNoteFacadeBridge = new ErpDeliveryNoteApiToErpDeliveryNoteFacadeBridge(
            $this->erpDeliveryNoteFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testCreateErpDeliveryNote(): void
    {
        $this->erpDeliveryNoteFacadeMock->expects(static::atLeastOnce())
            ->method('createErpDeliveryNote')
            ->with($this->erpDeliveryNoteTransferMock)
            ->willReturn($this->erpDeliveryNoteResponseTransferMock);

        static::assertEquals(
            $this->erpDeliveryNoteResponseTransferMock,
            $this->erpDeliveryNoteApiToErpDeliveryNoteFacadeBridge->createErpDeliveryNote($this->erpDeliveryNoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateErpDeliveryNote(): void
    {
        $this->erpDeliveryNoteFacadeMock->expects(static::atLeastOnce())
            ->method('updateErpDeliveryNote')
            ->with($this->erpDeliveryNoteTransferMock)
            ->willReturn($this->erpDeliveryNoteResponseTransferMock);

        static::assertEquals(
            $this->erpDeliveryNoteResponseTransferMock,
            $this->erpDeliveryNoteApiToErpDeliveryNoteFacadeBridge->updateErpDeliveryNote($this->erpDeliveryNoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testDeleteErpDeliveryNoteByIdErpDeliveryNote(): void
    {
        $idErpDeliveryNote = 1;

        $this->erpDeliveryNoteFacadeMock->expects(static::atLeastOnce())
            ->method('deleteErpDeliveryNoteByIdErpDeliveryNote')
            ->with($idErpDeliveryNote);

        $this->erpDeliveryNoteApiToErpDeliveryNoteFacadeBridge->deleteErpDeliveryNoteByIdErpDeliveryNote($idErpDeliveryNote);
    }

    /**
     * @return void
     */
    public function testFindErpDeliveryNoteByIdErpDeliveryNote(): void
    {
        $idErpDeliveryNote = 1;

        $this->erpDeliveryNoteFacadeMock->expects(static::atLeastOnce())
            ->method('findErpDeliveryNoteByIdErpDeliveryNote')
            ->with($idErpDeliveryNote)
            ->willReturn($this->erpDeliveryNoteTransferMock);

        static::assertEquals(
            $this->erpDeliveryNoteTransferMock,
            $this->erpDeliveryNoteApiToErpDeliveryNoteFacadeBridge->findErpDeliveryNoteByIdErpDeliveryNote($idErpDeliveryNote),
        );
    }
}
