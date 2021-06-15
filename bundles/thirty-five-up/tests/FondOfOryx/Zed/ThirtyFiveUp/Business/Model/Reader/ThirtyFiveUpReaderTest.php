<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpRepository;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;

class ThirtyFiveUpReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpOrderTransferMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Reader\ThirtyFiveUpReaderInterface
     */
    protected $reader;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this
            ->getMockBuilder(ThirtyFiveUpRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpOrderTransferMock = $this
            ->getMockBuilder(ThirtyFiveUpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ThirtyFiveUpReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFindThirtyFiveUpOrderByOrderReference(): void
    {
        $this->repositoryMock->expects($this->once())->method('findThirtyFiveUpOrderByThirtyFiveUpReference')->willReturn($this->thirtyFiveUpOrderTransferMock);
        $this->assertInstanceOf(ThirtyFiveUpOrderTransfer::class, $this->reader->findThirtyFiveUpOrderByOrderReference('test'));
    }

    /**
     * @return void
     */
    public function testFindThirtyFiveUpOrderByOrderReferenceReturnNull(): void
    {
        $this->repositoryMock->expects($this->once())->method('findThirtyFiveUpOrderByThirtyFiveUpReference');
        $this->assertNull($this->reader->findThirtyFiveUpOrderByOrderReference('test'));
    }

    /**
     * @return void
     */
    public function testFindThirtyFiveUpOrderByThirtyFiveUpReference(): void
    {
        $this->repositoryMock->expects($this->once())->method('findThirtyFiveUpOrderByOrderReference')->willReturn($this->thirtyFiveUpOrderTransferMock);
        $this->assertInstanceOf(ThirtyFiveUpOrderTransfer::class, $this->reader->findThirtyFiveUpOrderByThirtyFiveUpReference('test'));
    }

    /**
     * @return void
     */
    public function testFindThirtyFiveUpOrderByThirtyFiveUpReferenceReturnNull(): void
    {
        $this->repositoryMock->expects($this->once())->method('findThirtyFiveUpOrderByOrderReference');
        $this->assertNull($this->reader->findThirtyFiveUpOrderByThirtyFiveUpReference('test'));
    }

    /**
     * @return void
     */
    public function testFindThirtyFiveUpOrderById(): void
    {
        $this->repositoryMock->expects($this->once())->method('findThirtyFiveUpOrderById')->willReturn($this->thirtyFiveUpOrderTransferMock);
        $this->assertInstanceOf(ThirtyFiveUpOrderTransfer::class, $this->reader->findThirtyFiveUpOrderById(1));
    }

    /**
     * @return void
     */
    public function testFindThirtyFiveUpOrderByIdReturnNull(): void
    {
        $this->repositoryMock->expects($this->once())->method('findThirtyFiveUpOrderById');
        $this->assertNull($this->reader->findThirtyFiveUpOrderById(1));
    }
}
