<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepository;
use Generated\Shared\Transfer\ErpOrderItemCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderItemTransfer;

class ErpOrderItemReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderItemCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderItemCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderItemTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderItemReaderInterface
     */
    protected $reader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ErpOrderRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderItemCollectionTransferMock = $this->getMockBuilder(ErpOrderItemCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderItemTransfer = $this->getMockBuilder(ErpOrderItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpOrderItemReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFindErpOrderItemsByIdErpOrder(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpOrderItemsByIdErpOrder')->willReturn($this->erpOrderItemCollectionTransferMock);

        $result = $this->reader->findErpOrderItemsByIdErpOrder(1);

        $this->assertInstanceOf(ErpOrderItemCollectionTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testFindErpOrderItemByIdErpOrderItem(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpOrderItemByIdErpOrderItem')->willReturn($this->erpOrderItemTransfer);

        $result = $this->reader->findErpOrderItemByIdErpOrderItem(1);

        $this->assertInstanceOf(ErpOrderItemTransfer::class, $result);
    }
}
