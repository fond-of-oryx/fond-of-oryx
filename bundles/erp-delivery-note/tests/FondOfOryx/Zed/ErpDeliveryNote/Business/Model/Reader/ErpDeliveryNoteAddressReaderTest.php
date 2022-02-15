<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepository;
use Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer;

class ErpDeliveryNoteAddressReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteAddressTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteAddressReaderInterface
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

        $this->erpDeliveryNoteAddressTransfer = $this->getMockBuilder(ErpDeliveryNoteAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpDeliveryNoteAddressReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFindErpDeliveryNoteAddressByIdErpDeliveryNoteAddress(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpDeliveryNoteAddressByIdErpDeliveryNoteAddress')->willReturn($this->erpDeliveryNoteAddressTransfer);

        $result = $this->reader->findErpDeliveryNoteAddressByIdErpDeliveryNoteAddress(1);

        $this->assertInstanceOf(ErpDeliveryNoteAddressTransfer::class, $result);
    }
}
