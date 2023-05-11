<?php

namespace FondOfOryx\Zed\OrderBudget\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OrderBudget\Business\Resetter\OrderBudgetResetterInterface;
use FondOfOryx\Zed\OrderBudget\Business\Writer\OrderBudgetWriterInterface;
use FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetRepository;
use Generated\Shared\Transfer\OrderBudgetTransfer;

class OrderBudgetFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OrderBudget\Business\OrderBudgetBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Business\Resetter\OrderBudgetResetterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderBudgetResetterMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Business\Writer\OrderBudgetWriterInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $orderBudgetWriterMock;

    /**
     * @var \Generated\Shared\Transfer\OrderBudgetTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $orderBudgetTransferMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Business\OrderBudgetFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(OrderBudgetBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetResetterMock = $this->getMockBuilder(OrderBudgetResetterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetWriterMock = $this->getMockBuilder(OrderBudgetWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetTransferMock = $this->getMockBuilder(OrderBudgetTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(OrderBudgetRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new OrderBudgetFacade();
        $this->facade->setFactory($this->factoryMock);
        $this->facade->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testResetOrderBudgets(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createOrderBudgetResetter')
            ->willReturn($this->orderBudgetResetterMock);

        $this->orderBudgetResetterMock->expects(static::atLeastOnce())
            ->method('resetAll');

        $this->facade->resetOrderBudgets();
    }

    /**
     * @return void
     */
    public function testCreateOrderBudgets(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createOrderBudgetWriter')
            ->willReturn($this->orderBudgetWriterMock);

        $this->orderBudgetWriterMock->expects(static::atLeastOnce())
            ->method('create')
            ->with(null)
            ->willReturn($this->orderBudgetTransferMock);

        static::assertEquals(
            $this->orderBudgetTransferMock,
            $this->facade->createOrderBudget(),
        );
    }

    /**
     * @return void
     */
    public function testUpdateOrderBudget(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createOrderBudgetWriter')
            ->willReturn($this->orderBudgetWriterMock);

        $this->orderBudgetWriterMock->expects(static::atLeastOnce())
            ->method('update')
            ->with($this->orderBudgetTransferMock);

        $this->facade->updateOrderBudget($this->orderBudgetTransferMock);
    }

    /**
     * @return void
     */
    public function testFindOrderBudgetByIdOrderBudget(): void
    {
        $idOrderBudget = 1;

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findOrderBudgetByIdOrderBudget')
            ->with($idOrderBudget)
            ->willReturn($this->orderBudgetTransferMock);

        static::assertEquals(
            $this->orderBudgetTransferMock,
            $this->facade->findOrderBudgetByIdOrderBudget($idOrderBudget),
        );
    }

    /**
     * @return void
     */
    public function testFindOrderBudgetsByOrderBudgetIds(): void
    {
        $orderBudgetIds = [1];
        $orderBudgetTransferMocks = [$this->orderBudgetTransferMock];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findOrderBudgetsByOrderBudgetIds')
            ->with($orderBudgetIds)
            ->willReturn($orderBudgetTransferMocks);

        static::assertEquals(
            $orderBudgetTransferMocks,
            $this->facade->findOrderBudgetsByOrderBudgetIds($orderBudgetIds),
        );
    }
}
