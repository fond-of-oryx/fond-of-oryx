<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepository;
use Generated\Shared\Transfer\ErpInvoiceItemCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoiceItemTransfer;

class ErpInvoiceItemReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceItemCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceItemCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceItemTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceItemReaderInterface
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

        $this->erpInvoiceItemCollectionTransferMock = $this->getMockBuilder(ErpInvoiceItemCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceItemTransfer = $this->getMockBuilder(ErpInvoiceItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpInvoiceItemReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFindErpInvoiceItemsByIdErpInvoice(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpInvoiceItemsByIdErpInvoice')->willReturn($this->erpInvoiceItemCollectionTransferMock);

        $result = $this->reader->findErpInvoiceItemsByIdErpInvoice(1);

        $this->assertInstanceOf(ErpInvoiceItemCollectionTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testFindErpInvoiceItemByIdErpInvoiceItem(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpInvoiceItemByIdErpInvoiceItem')->willReturn($this->erpInvoiceItemTransfer);

        $result = $this->reader->findErpInvoiceItemByIdErpInvoiceItem(1);

        $this->assertInstanceOf(ErpInvoiceItemTransfer::class, $result);
    }
}
