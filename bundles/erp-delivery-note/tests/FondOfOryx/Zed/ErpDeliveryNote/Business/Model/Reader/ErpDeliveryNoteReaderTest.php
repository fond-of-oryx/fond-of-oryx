<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepository;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

class ErpDeliveryNoteReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteReaderInterface
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

        $this->erpDeliveryNoteTransfer = $this->getMockBuilder(ErpDeliveryNoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpDeliveryNoteReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFindErpDeliveryNoteByIdErpDeliveryNote(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpDeliveryNoteByIdErpDeliveryNote')->willReturn($this->erpDeliveryNoteTransfer);

        $result = $this->reader->findErpDeliveryNoteByIdErpDeliveryNote(1);

        $this->assertInstanceOf(ErpDeliveryNoteTransfer::class, $result);
    }
}
