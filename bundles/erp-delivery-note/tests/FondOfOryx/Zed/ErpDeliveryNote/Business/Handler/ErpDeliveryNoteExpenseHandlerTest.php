<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Handler;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteExpenseReaderInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteExpenseWriterInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteExpenseCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

class ErpDeliveryNoteExpenseHandlerTest extends Unit
{
    /**
     * @var string
     */
    protected const NEW = 'new';

    /**
     * @var string
     */
    protected const UPDATE = 'update';

    /**
     * @var string
     */
    protected const DELETE = 'delete';

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteExpenseWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $ExpenseWriterMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteExpenseReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $ExpenseReaderMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteExpenseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteExpenseCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteExpenseCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteExpenseHandlerInterface
     */
    protected $handler;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->ExpenseWriterMock = $this->getMockBuilder(ErpDeliveryNoteExpenseWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->ExpenseReaderMock = $this->getMockBuilder(ErpDeliveryNoteExpenseReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteTransferMock = $this->getMockBuilder(ErpDeliveryNoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteExpenseTransferMock = $this->getMockBuilder(ErpDeliveryNoteExpenseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteExpenseCollectionTransferMock = $this->getMockBuilder(ErpDeliveryNoteExpenseCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->handler = new ErpDeliveryNoteExpenseHandler(
            $this->ExpenseWriterMock,
            $this->ExpenseReaderMock,
        );
    }

    /**
     * @return void
     */
    public function testHandleNew(): void
    {
        $Expenses = new ArrayObject([$this->erpDeliveryNoteExpenseTransferMock]);

        $this->ExpenseReaderMock->expects($this->atLeastOnce())->method('findErpDeliveryNoteExpensesByIdErpDeliveryNote')->willReturn($this->erpDeliveryNoteExpenseCollectionTransferMock);
        $this->erpDeliveryNoteExpenseCollectionTransferMock->expects($this->once())->method('getExpenses')->willReturn(new ArrayObject());

        $this->erpDeliveryNoteExpenseTransferMock->expects($this->atLeastOnce())->method('getName')->willReturn('name3');

        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('getIdErpDeliveryNote')->willReturn(1);
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('getExpenses')->willReturn($Expenses);
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('setExpenses')->willReturn($this->erpDeliveryNoteTransferMock);

        $this->ExpenseWriterMock->expects($this->once())->method('create')->willReturn($this->erpDeliveryNoteExpenseTransferMock);
        $this->ExpenseWriterMock->expects($this->never())->method('delete');
        $this->ExpenseWriterMock->expects($this->never())->method('update');

        $deliveryNote = $this->handler->handle($this->erpDeliveryNoteTransferMock);
    }

    /**
     * @return void
     */
    public function testHandleUpdate(): void
    {
        $existingExpense1 = clone $this->erpDeliveryNoteExpenseTransferMock;
        $Expenses = new ArrayObject([$this->erpDeliveryNoteExpenseTransferMock]);
        $existingExpenses = new ArrayObject([$existingExpense1]);

        $this->ExpenseReaderMock->expects($this->atLeastOnce())->method('findErpDeliveryNoteExpensesByIdErpDeliveryNote')->willReturn($this->erpDeliveryNoteExpenseCollectionTransferMock);
        $this->erpDeliveryNoteExpenseCollectionTransferMock->expects($this->atLeastOnce())->method('getExpenses')->willReturn($existingExpenses);

        $existingExpense1->expects($this->atLeastOnce())->method('getName')->willReturn('Name1');
        $existingExpense1->expects($this->atLeastOnce())->method('getIdErpDeliveryNoteExpense')->willReturn(1);
        $existingExpense1->expects($this->atLeastOnce())->method('fromArray');
        $existingExpense1->expects($this->atLeastOnce())->method('toArray')->willReturn([]);
        $this->erpDeliveryNoteExpenseTransferMock->expects($this->atLeastOnce())->method('getName')->willReturn('Name1');
        $this->erpDeliveryNoteExpenseTransferMock->expects($this->atLeastOnce())->method('fromArray');
        $this->erpDeliveryNoteExpenseTransferMock->expects($this->atLeastOnce())->method('toArray')->willReturn([]);
        $this->erpDeliveryNoteExpenseTransferMock->expects($this->never())->method('getIdErpDeliveryNoteExpense');

        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('getIdErpDeliveryNote')->willReturn(1);
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('getExpenses')->willReturn($Expenses);
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('setExpenses')->willReturn($this->erpDeliveryNoteTransferMock);

        $this->ExpenseWriterMock->expects($this->never())->method('create');
        $this->ExpenseWriterMock->expects($this->never())->method('delete');
        $this->ExpenseWriterMock->expects($this->once())->method('update')->willReturn($this->erpDeliveryNoteExpenseTransferMock);

        $this->ExpenseReaderMock->expects($this->once())->method('findErpDeliveryNoteExpenseByIdErpDeliveryNoteExpense')->willReturn($this->erpDeliveryNoteExpenseTransferMock);

        $deliveryNote = $this->handler->handle($this->erpDeliveryNoteTransferMock);
    }

    /**
     * @return void
     */
    public function testHandleDelete(): void
    {
        $existingExpense1 = clone $this->erpDeliveryNoteExpenseTransferMock;
        $existingExpense2 = clone $this->erpDeliveryNoteExpenseTransferMock;
        $Expenses = new ArrayObject([$this->erpDeliveryNoteExpenseTransferMock]);
        $existingExpenses = new ArrayObject([$existingExpense1, $existingExpense2]);

        $this->ExpenseReaderMock->expects($this->atLeastOnce())->method('findErpDeliveryNoteExpensesByIdErpDeliveryNote')->willReturn($this->erpDeliveryNoteExpenseCollectionTransferMock);
        $this->erpDeliveryNoteExpenseCollectionTransferMock->expects($this->atLeastOnce())->method('getExpenses')->willReturn($existingExpenses);

        $existingExpense1->expects($this->atLeastOnce())->method('getName')->willReturn('Name1');
        $existingExpense1->expects($this->atLeastOnce())->method('getIdErpDeliveryNoteExpense')->willReturn(1);
        $existingExpense2->expects($this->atLeastOnce())->method('getName')->willReturn('Name2');
        $existingExpense2->expects($this->atLeastOnce())->method('getIdErpDeliveryNoteExpense')->willReturn(2);
        $this->erpDeliveryNoteExpenseTransferMock->expects($this->atLeastOnce())->method('getName')->willReturn('Name3');

        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('getIdErpDeliveryNote')->willReturn(1);
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('getExpenses')->willReturn($Expenses);
        $this->erpDeliveryNoteTransferMock->expects($this->atLeastOnce())->method('setExpenses')->willReturn($this->erpDeliveryNoteTransferMock);

        $this->ExpenseWriterMock->expects($this->atLeastOnce())->method('create')->willReturn($this->erpDeliveryNoteExpenseTransferMock);
        $this->ExpenseWriterMock->expects($this->exactly(2))->method('delete');
        $this->ExpenseWriterMock->expects($this->never())->method('update');

        $deliveryNote = $this->handler->handle($this->erpDeliveryNoteTransferMock);
    }
}
