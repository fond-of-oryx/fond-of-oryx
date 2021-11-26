<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepository;
use Generated\Shared\Transfer\ErpInvoiceExpenseCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoiceExpenseTransfer;

class ErpInvoiceExpenseReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceExpenseCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceExpenseCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceExpenseTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceExpenseReaderInterface
     */
    protected $reader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ErpInvoiceRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceExpenseCollectionTransferMock = $this->getMockBuilder(ErpInvoiceExpenseCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceExpenseTransfer = $this->getMockBuilder(ErpInvoiceExpenseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpInvoiceExpenseReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFindErpInvoiceExpensesByIdErpInvoice(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpInvoiceExpensesByIdErpInvoice')->willReturn($this->erpInvoiceExpenseCollectionTransferMock);

        $result = $this->reader->findErpInvoiceExpensesByIdErpInvoice(1);

        $this->assertInstanceOf(ErpInvoiceExpenseCollectionTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testFindErpInvoiceExpenseByIdErpInvoiceExpense(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpInvoiceExpenseByIdErpInvoiceExpense')->willReturn($this->erpInvoiceExpenseTransfer);

        $result = $this->reader->findErpInvoiceExpenseByIdErpInvoiceExpense(1);

        $this->assertInstanceOf(ErpInvoiceExpenseTransfer::class, $result);
    }
}
