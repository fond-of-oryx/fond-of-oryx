<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Writer;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpEntityManager;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;

class ThirtyFiveUpOrderWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpOrderTransferMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Writer\ThirtyFiveUpOrderWriterInterface
     */
    protected $writer;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this
            ->getMockBuilder(ThirtyFiveUpEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpOrderTransferMock = $this
            ->getMockBuilder(ThirtyFiveUpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->writer = new ThirtyFiveUpOrderWriter($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->entityManagerMock->expects($this->once())->method('createThirtyFiveUpOrder')->willReturn($this->thirtyFiveUpOrderTransferMock);
        $this->writer->create($this->thirtyFiveUpOrderTransferMock);
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->entityManagerMock->expects($this->once())->method('updateThirtyFiveUpOrder')->willReturn($this->thirtyFiveUpOrderTransferMock);
        $this->writer->update($this->thirtyFiveUpOrderTransferMock);
    }
}
