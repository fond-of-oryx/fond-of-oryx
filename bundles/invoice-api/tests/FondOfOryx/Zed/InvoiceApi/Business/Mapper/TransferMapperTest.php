<?php

namespace FondOfOryx\Zed\InvoiceApi\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\InvoiceTransfer;

class TransferMapperTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\InvoiceTransfer
     */
    protected $invoiceTransferMock;

    /**
     * @var \FondOfOryx\Zed\InvoiceApi\Business\Mapper\TransferMapper
     */
    protected $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->invoiceTransferMock = $this->getMockBuilder(InvoiceTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new TransferMapper();
    }

    /**
     * @return void
     */
    public function testToTransfer(): void
    {
        $invoiceTransfer = $this->mapper->toTransfer([
            'invoiceNumber' => 'INVOICE_NUMBER',
            'orderReference' => 'ORDER_REFERENCE',
        ]);

        static::assertEquals('INVOICE_NUMBER', $invoiceTransfer->getInvoiceNumber());
        static::assertEquals('ORDER_REFERENCE', $invoiceTransfer->getOrderReference());
    }
}
