<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepository;
use Generated\Shared\Transfer\ErpDeliveryNoteTrackingCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer;

class ErpDeliveryNoteTrackingReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteTrackingCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteTrackingCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteTrackingTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteTrackingReaderInterface
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

        $this->erpDeliveryNoteTrackingCollectionTransferMock = $this->getMockBuilder(ErpDeliveryNoteTrackingCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteTrackingTransfer = $this->getMockBuilder(ErpDeliveryNoteTrackingTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpDeliveryNoteTrackingReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFindErpDeliveryNoteTrackingByIdErpDeliveryNote(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpDeliveryNoteTrackingByIdErpDeliveryNote')->willReturn($this->erpDeliveryNoteTrackingCollectionTransferMock);

        $result = $this->reader->findErpDeliveryNoteTrackingByIdErpDeliveryNote(1);

        $this->assertInstanceOf(ErpDeliveryNoteTrackingCollectionTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testFindErpDeliveryNoteTrackingByIdErpDeliveryNoteTracking(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpDeliveryNoteTrackingByIdErpDeliveryNoteTracking')->willReturn($this->erpDeliveryNoteTrackingTransfer);

        $result = $this->reader->findErpDeliveryNoteTrackingByIdErpDeliveryNoteTracking(1);

        $this->assertInstanceOf(ErpDeliveryNoteTrackingTransfer::class, $result);
    }
}
