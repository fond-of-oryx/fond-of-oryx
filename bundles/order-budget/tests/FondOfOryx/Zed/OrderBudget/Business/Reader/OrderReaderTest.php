<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetRepository;
use Generated\Shared\Transfer\OrderBudgetTransfer;

class OrderReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\OrderBudgetTransfer>
     */
    protected $orderBudgetTransferMocks;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Business\Reader\OrderBudgetReader
     */
    protected $orderReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(OrderBudgetRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetTransferMocks = [
            $this->getMockBuilder(OrderBudgetTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->orderReader = new OrderBudgetReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testGetAll(): void
    {
        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findAllOrderBudgets')
            ->willReturn($this->orderBudgetTransferMocks);

        static::assertEquals(
            $this->orderBudgetTransferMocks,
            $this->orderReader->getAll(),
        );
    }

    /**
     * @return void
     */
    public function testGetByIds(): void
    {
        $orderBudgetIds = [11];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findOrderBudgetsByOrderBudgetIds')
            ->with($orderBudgetIds)
            ->willReturn($this->orderBudgetTransferMocks);

        static::assertEquals(
            $this->orderBudgetTransferMocks,
            $this->orderReader->getByIds($orderBudgetIds),
        );
    }
}
