<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepository;
use Generated\Shared\Transfer\ErpDeliveryNoteExpenseCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer;

class ErpDeliveryNoteExpenseReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteExpenseCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteExpenseCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteExpenseTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteExpenseReaderInterface
     */
    protected $reader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ErpDeliveryNoteRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteExpenseCollectionTransferMock = $this->getMockBuilder(ErpDeliveryNoteExpenseCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteExpenseTransfer = $this->getMockBuilder(ErpDeliveryNoteExpenseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpDeliveryNoteExpenseReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFindErpDeliveryNoteExpensesByIdErpDeliveryNote(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpDeliveryNoteExpensesByIdErpDeliveryNote')->willReturn($this->erpDeliveryNoteExpenseCollectionTransferMock);

        $result = $this->reader->findErpDeliveryNoteExpensesByIdErpDeliveryNote(1);

        $this->assertInstanceOf(ErpDeliveryNoteExpenseCollectionTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testFindErpDeliveryNoteExpenseByIdErpDeliveryNoteExpense(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpDeliveryNoteExpenseByIdErpDeliveryNoteExpense')->willReturn($this->erpDeliveryNoteExpenseTransfer);

        $result = $this->reader->findErpDeliveryNoteExpenseByIdErpDeliveryNoteExpense(1);

        $this->assertInstanceOf(ErpDeliveryNoteExpenseTransfer::class, $result);
    }
}
