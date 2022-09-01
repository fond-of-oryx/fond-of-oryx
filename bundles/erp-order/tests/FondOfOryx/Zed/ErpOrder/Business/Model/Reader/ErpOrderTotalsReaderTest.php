<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepository;
use Generated\Shared\Transfer\ErpOrderTotalsTransfer;

class ErpOrderTotalsReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderTotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTotalsTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderTotalsReaderInterface
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

        $this->erpOrderTotalsTransferMock = $this->getMockBuilder(ErpOrderTotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpOrderTotalsReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFindErpOrderTotalByIdErpOrderTotals(): void
    {
        $idErpOrderTotals = 1;

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findErpOrderTotalsByIdErpOrderTotals')
            ->with($idErpOrderTotals)
            ->willReturn($this->erpOrderTotalsTransferMock);

        static::assertEquals(
            $this->erpOrderTotalsTransferMock,
            $this->reader->findErpOrderTotalsByIdErpOrderTotals($idErpOrderTotals),
        );
    }
}
