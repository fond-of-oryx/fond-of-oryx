<?php

namespace FondOfOryx\Zed\Invoice\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\Invoice\Business\Model\InvoiceAddressWriter;
use FondOfOryx\Zed\Invoice\Business\Model\InvoiceItemsWriter;
use FondOfOryx\Zed\Invoice\Business\Model\InvoiceReferenceGenerator;
use FondOfOryx\Zed\Invoice\Business\Model\InvoiceWriter;
use Generated\Shared\Transfer\InvoiceResponseTransfer;
use Generated\Shared\Transfer\InvoiceTransfer;

class InvoiceFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\Business\InvoiceBusinessFactory
     */
    protected $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\Business\Model\InvoiceWriter
     */
    protected $invoiceWriterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\InvoiceTransfer
     */
    protected $invoiceTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\InvoiceResponseTransfer
     */
    protected $invoiceResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\Business\Model\InvoiceAddressWriter
     */
    protected $invoiceAddressWriterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\Business\Model\InvoiceItemsWriter
     */
    protected $invoiceItemsWriterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\Business\Model\InvoiceReferenceGenerator
     */
    protected $invoiceReferenceGeneratorMock;

    /**
     * @var \FondOfOryx\Zed\Invoice\Business\InvoiceFacadeInterface
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(InvoiceBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceWriterMock = $this->getMockBuilder(InvoiceWriter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceTransferMock = $this->getMockBuilder(InvoiceTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceResponseTransferMock = $this->getMockBuilder(InvoiceResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceAddressWriterMock = $this->getMockBuilder(InvoiceAddressWriter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceItemsWriterMock = $this->getMockBuilder(InvoiceItemsWriter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceReferenceGeneratorMock = $this->getMockBuilder(InvoiceReferenceGenerator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new InvoiceFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testCreateInvoice(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createInvoiceWriter')
            ->willReturn($this->invoiceWriterMock);

        $this->invoiceWriterMock->expects(static::atLeastOnce())
            ->method('create')
            ->with($this->invoiceTransferMock)
            ->willReturn($this->invoiceResponseTransferMock);

        static::assertEquals($this->invoiceResponseTransferMock, $this->facade->createInvoice($this->invoiceTransferMock));
    }

    /**
     * @return void
     */
    public function testCreateInvoiceAddress(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createInvoiceAddressWriter')
            ->willReturn($this->invoiceAddressWriterMock);

        $this->invoiceAddressWriterMock->expects(static::atLeastOnce())
            ->method('create')
            ->with($this->invoiceTransferMock)
            ->willReturn($this->invoiceTransferMock);

        static::assertEquals($this->invoiceTransferMock, $this->facade->createInvoiceAddress($this->invoiceTransferMock));
    }

    /**
     * @return void
     */
    public function testCreateInvoiceItems(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createInvoiceItemsWriter')
            ->willReturn($this->invoiceItemsWriterMock);

        $this->invoiceItemsWriterMock->expects(static::atLeastOnce())
            ->method('create')
            ->with($this->invoiceTransferMock)
            ->willReturn($this->invoiceTransferMock);

        static::assertEquals($this->invoiceTransferMock, $this->facade->createInvoiceItems($this->invoiceTransferMock));
    }

    /**
     * @return void
     */
    public function testCreateInvoiceReference(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createInvoiceReferenceGenerator')
            ->willReturn($this->invoiceReferenceGeneratorMock);

        $this->invoiceReferenceGeneratorMock->expects(static::atLeastOnce())
            ->method('generate')
            ->willReturn('string');

        static::assertEquals('string', $this->facade->createInvoiceReference());
    }
}
