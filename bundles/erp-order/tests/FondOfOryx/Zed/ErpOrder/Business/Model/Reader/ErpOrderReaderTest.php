<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepository;
use Generated\Shared\Transfer\ErpOrderTransfer;

class ErpOrderReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ReaderInterface
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

        $this->erpOrderTransfer = $this->getMockBuilder(ErpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpOrderReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFindErpOrderByIdErpOrder(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpOrderByIdErpOrder')->willReturn($this->erpOrderTransfer);

        $result = $this->reader->findErpOrderByIdErpOrder(1);

        $this->assertInstanceOf(ErpOrderTransfer::class, $result);
    }
}
