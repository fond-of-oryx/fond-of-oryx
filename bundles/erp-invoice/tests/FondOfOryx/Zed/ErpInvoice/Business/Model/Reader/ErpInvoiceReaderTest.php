<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepository;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

class ErpInvoiceReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ReaderInterface
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

        $this->erpInvoiceTransfer = $this->getMockBuilder(ErpInvoiceTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpInvoiceReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFindErpInvoiceByIdErpInvoice(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpInvoiceByIdErpInvoice')->willReturn($this->erpInvoiceTransfer);

        $result = $this->reader->findErpInvoiceByIdErpInvoice(1);

        $this->assertInstanceOf(ErpInvoiceTransfer::class, $result);
    }
}
