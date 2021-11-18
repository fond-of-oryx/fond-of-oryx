<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepository;
use Generated\Shared\Transfer\ErpInvoiceAmountTransfer;

class ErpInvoiceAmountReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceTotalTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceAmountReaderInterface
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

        $this->erpInvoiceTotalTransfer = $this->getMockBuilder(ErpInvoiceAmountTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpInvoiceAmountReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFindErpInvoiceAmountByIdErpInvoiceAmount(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpInvoiceAmountByIdErpInvoiceAmount')->willReturn($this->erpInvoiceTotalTransfer);

        $result = $this->reader->findErpInvoiceAmountByIdErpInvoiceAmount(1);

        $this->assertInstanceOf(ErpInvoiceAmountTransfer::class, $result);
    }
}
