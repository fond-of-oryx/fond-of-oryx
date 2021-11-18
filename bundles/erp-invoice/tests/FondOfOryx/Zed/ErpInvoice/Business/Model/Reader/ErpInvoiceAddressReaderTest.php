<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepository;
use Generated\Shared\Transfer\ErpInvoiceAddressTransfer;

class ErpInvoiceAddressReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceAddressTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceAddressReaderInterface
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

        $this->erpInvoiceAddressTransfer = $this->getMockBuilder(ErpInvoiceAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpInvoiceAddressReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFindErpInvoiceAddressByIdErpInvoiceAddress(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpInvoiceAddressByIdErpInvoiceAddress')->willReturn($this->erpInvoiceAddressTransfer);

        $result = $this->reader->findErpInvoiceAddressByIdErpInvoiceAddress(1);

        $this->assertInstanceOf(ErpInvoiceAddressTransfer::class, $result);
    }
}
