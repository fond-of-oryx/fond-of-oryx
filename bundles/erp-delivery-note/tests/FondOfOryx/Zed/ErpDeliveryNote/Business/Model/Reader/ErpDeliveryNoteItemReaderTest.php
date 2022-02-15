<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepository;
use Generated\Shared\Transfer\ErpDeliveryNoteItemCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer;

class ErpDeliveryNoteItemReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteItemCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteItemCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteItemTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteItemReaderInterface
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

        $this->erpDeliveryNoteItemCollectionTransferMock = $this->getMockBuilder(ErpDeliveryNoteItemCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteItemTransfer = $this->getMockBuilder(ErpDeliveryNoteItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpDeliveryNoteItemReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFindErpDeliveryNoteItemsByIdErpDeliveryNote(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpDeliveryNoteItemsByIdErpDeliveryNote')->willReturn($this->erpDeliveryNoteItemCollectionTransferMock);

        $result = $this->reader->findErpDeliveryNoteItemsByIdErpDeliveryNote(1);

        $this->assertInstanceOf(ErpDeliveryNoteItemCollectionTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testFindErpDeliveryNoteItemByIdErpDeliveryNoteItem(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpDeliveryNoteItemByIdErpDeliveryNoteItem')->willReturn($this->erpDeliveryNoteItemTransfer);

        $result = $this->reader->findErpDeliveryNoteItemByIdErpDeliveryNoteItem(1);

        $this->assertInstanceOf(ErpDeliveryNoteItemTransfer::class, $result);
    }
}
