<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepository;
use Generated\Shared\Transfer\ErpOrderTotalTransfer;

class ErpOrderTotalReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTotalTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderTotalReaderInterface
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

        $this->erpOrderTotalTransfer = $this->getMockBuilder(ErpOrderTotalTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpOrderTotalReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFindErpOrderTotalByIdErpOrderTotal(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpOrderTotalByIdErpOrderTotal')->willReturn($this->erpOrderTotalTransfer);

        $result = $this->reader->findErpOrderTotalByIdErpOrderTotal(1);

        $this->assertInstanceOf(ErpOrderTotalTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testFindErpOrderTotalByIdErpOrder(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpOrderTotalByIdErpOrder')->willReturn($this->erpOrderTotalTransfer);

        $result = $this->reader->findErpOrderTotalByIdErpOrder(1);

        $this->assertInstanceOf(ErpOrderTotalTransfer::class, $result);
    }
}
