<?php

namespace FondOfOryx\Zed\InvoiceApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\Invoice\Business\InvoiceFacade;
use Generated\Shared\Transfer\InvoiceResponseTransfer;
use Generated\Shared\Transfer\InvoiceTransfer;

class InvoiceApiToInvoiceFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\Business\InvoiceFacade
     */
    protected $invoiceFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\InvoiceTransfer
     */
    protected $invoiceTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\InvoiceResponseTransfer
     */
    protected $invoiceResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->invoiceFacadeMock = $this->getMockBuilder(InvoiceFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceTransferMock = $this->getMockBuilder(InvoiceTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceResponseTransferMock = $this->getMockBuilder(InvoiceResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new InvoiceApiToInvoiceFacadeBridge($this->invoiceFacadeMock);
    }

    /**
     * @return void
     */
    protected function testCreateInvoice(): void
    {
        $this->invoiceFacadeMock->expects(static::atLeastOnce())
            ->with($this->invoiceTransferMock)
            ->willReturn($this->invoiceResponseTransferMock);

        static::assertEquals($this->invoiceResponseTransferMock, $this->bridge->createInvoice($this->invoiceTransferMock));
    }
}
