<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Handler;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceExpenseReaderInterface;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceExpenseWriterInterface;
use Generated\Shared\Transfer\ErpInvoiceExpenseCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoiceExpenseTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

class ErpInvoiceExpenseHandlerTest extends Unit
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
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceExpenseWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $ExpenseWriterMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceExpenseReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $ExpenseReaderMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceExpenseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceExpenseCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceExpenseCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceExpenseHandlerInterface
     */
    protected $handler;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->ExpenseWriterMock = $this->getMockBuilder(ErpInvoiceExpenseWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->ExpenseReaderMock = $this->getMockBuilder(ErpInvoiceExpenseReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceTransferMock = $this->getMockBuilder(ErpInvoiceTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceExpenseTransferMock = $this->getMockBuilder(ErpInvoiceExpenseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceExpenseCollectionTransferMock = $this->getMockBuilder(ErpInvoiceExpenseCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->handler = new ErpInvoiceExpenseHandler(
            $this->ExpenseWriterMock,
            $this->ExpenseReaderMock,
        );
    }

    /**
     * @return void
     */
    public function testHandleNew(): void
    {
        $Expenses = new ArrayObject([$this->erpInvoiceExpenseTransferMock]);

        $this->ExpenseReaderMock->expects($this->atLeastOnce())->method('findErpInvoiceExpensesByIdErpInvoice')->willReturn($this->erpInvoiceExpenseCollectionTransferMock);
        $this->erpInvoiceExpenseCollectionTransferMock->expects($this->once())->method('getExpenses')->willReturn(new ArrayObject());

        $this->erpInvoiceExpenseTransferMock->expects($this->atLeastOnce())->method('getName')->willReturn('name3');

        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())->method('getIdErpInvoice')->willReturn(1);
        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())->method('getExpenses')->willReturn($Expenses);
        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())->method('setExpenses')->willReturn($this->erpInvoiceTransferMock);

        $this->ExpenseWriterMock->expects($this->once())->method('create')->willReturn($this->erpInvoiceExpenseTransferMock);
        $this->ExpenseWriterMock->expects($this->never())->method('delete');
        $this->ExpenseWriterMock->expects($this->never())->method('update');

        $invoice = $this->handler->handle($this->erpInvoiceTransferMock);
    }

    /**
     * @return void
     */
    public function testHandleUpdate(): void
    {
        $existingExpense1 = clone $this->erpInvoiceExpenseTransferMock;
        $Expenses = new ArrayObject([$this->erpInvoiceExpenseTransferMock]);
        $existingExpenses = new ArrayObject([$existingExpense1]);

        $this->ExpenseReaderMock->expects($this->atLeastOnce())->method('findErpInvoiceExpensesByIdErpInvoice')->willReturn($this->erpInvoiceExpenseCollectionTransferMock);
        $this->erpInvoiceExpenseCollectionTransferMock->expects($this->atLeastOnce())->method('getExpenses')->willReturn($existingExpenses);

        $existingExpense1->expects($this->atLeastOnce())->method('getName')->willReturn('Name1');
        $existingExpense1->expects($this->atLeastOnce())->method('getIdErpInvoiceExpense')->willReturn(1);
        $existingExpense1->expects($this->atLeastOnce())->method('fromArray');
        $existingExpense1->expects($this->atLeastOnce())->method('toArray')->willReturn([]);
        $this->erpInvoiceExpenseTransferMock->expects($this->atLeastOnce())->method('getName')->willReturn('Name1');
        $this->erpInvoiceExpenseTransferMock->expects($this->atLeastOnce())->method('fromArray');
        $this->erpInvoiceExpenseTransferMock->expects($this->atLeastOnce())->method('toArray')->willReturn([]);
        $this->erpInvoiceExpenseTransferMock->expects($this->never())->method('getIdErpInvoiceExpense');

        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())->method('getIdErpInvoice')->willReturn(1);
        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())->method('getExpenses')->willReturn($Expenses);
        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())->method('setExpenses')->willReturn($this->erpInvoiceTransferMock);

        $this->ExpenseWriterMock->expects($this->never())->method('create');
        $this->ExpenseWriterMock->expects($this->never())->method('delete');
        $this->ExpenseWriterMock->expects($this->once())->method('update')->willReturn($this->erpInvoiceExpenseTransferMock);

        $this->ExpenseReaderMock->expects($this->once())->method('findErpInvoiceExpenseByIdErpInvoiceExpense')->willReturn($this->erpInvoiceExpenseTransferMock);

        $invoice = $this->handler->handle($this->erpInvoiceTransferMock);
    }

    /**
     * @return void
     */
    public function testHandleDelete(): void
    {
        $existingExpense1 = clone $this->erpInvoiceExpenseTransferMock;
        $existingExpense2 = clone $this->erpInvoiceExpenseTransferMock;
        $Expenses = new ArrayObject([$this->erpInvoiceExpenseTransferMock]);
        $existingExpenses = new ArrayObject([$existingExpense1, $existingExpense2]);

        $this->ExpenseReaderMock->expects($this->atLeastOnce())->method('findErpInvoiceExpensesByIdErpInvoice')->willReturn($this->erpInvoiceExpenseCollectionTransferMock);
        $this->erpInvoiceExpenseCollectionTransferMock->expects($this->atLeastOnce())->method('getExpenses')->willReturn($existingExpenses);

        $existingExpense1->expects($this->atLeastOnce())->method('getName')->willReturn('Name1');
        $existingExpense1->expects($this->atLeastOnce())->method('getIdErpInvoiceExpense')->willReturn(1);
        $existingExpense2->expects($this->atLeastOnce())->method('getName')->willReturn('Name2');
        $existingExpense2->expects($this->atLeastOnce())->method('getIdErpInvoiceExpense')->willReturn(2);
        $this->erpInvoiceExpenseTransferMock->expects($this->atLeastOnce())->method('getName')->willReturn('Name3');

        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())->method('getIdErpInvoice')->willReturn(1);
        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())->method('getExpenses')->willReturn($Expenses);
        $this->erpInvoiceTransferMock->expects($this->atLeastOnce())->method('setExpenses')->willReturn($this->erpInvoiceTransferMock);

        $this->ExpenseWriterMock->expects($this->atLeastOnce())->method('create')->willReturn($this->erpInvoiceExpenseTransferMock);
        $this->ExpenseWriterMock->expects($this->exactly(2))->method('delete');
        $this->ExpenseWriterMock->expects($this->never())->method('update');

        $invoice = $this->handler->handle($this->erpInvoiceTransferMock);
    }
}
