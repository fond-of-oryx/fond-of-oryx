<?php

namespace FondOfOryx\Zed\Invoice\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\Invoice\Persistence\InvoiceEntityManager;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\InvoiceTransfer;

class InvoiceAddressWriterTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\Persistence\InvoiceEntityManager
     */
    protected $entityManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\InvoiceTransfer
     */
    protected $invoiceTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\AddressTransfer
     */
    protected $addressTransferMock;

    /**
     * @var \FondOfOryx\Zed\Invoice\Business\Model\InvoiceAddressWriterInterface
     */
    protected $invoiceAddressWriter;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(InvoiceEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceTransferMock = $this->getMockBuilder(InvoiceTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->addressTransferMock = $this->getMockBuilder(AddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceAddressWriter = new InvoiceAddressWriter($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->invoiceTransferMock->expects(static::atLeastOnce())
            ->method('requireAddress')
            ->willReturnSelf();

        $this->invoiceTransferMock->expects(static::atLeastOnce())
            ->method('getAddress')
            ->willReturn($this->addressTransferMock);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createInvoiceAddress')
            ->with($this->addressTransferMock)
            ->willReturn($this->addressTransferMock);

        $this->invoiceTransferMock->expects(static::atLeastOnce())
            ->method('setAddress')
            ->with($this->addressTransferMock)
            ->willReturnSelf();

        static::assertEquals($this->invoiceTransferMock, $this->invoiceAddressWriter->create($this->invoiceTransferMock));
    }
}
