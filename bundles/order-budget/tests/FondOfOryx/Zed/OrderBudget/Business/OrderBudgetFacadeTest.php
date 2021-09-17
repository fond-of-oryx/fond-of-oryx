<?php

namespace FondOfOryx\Zed\OrderBudget\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OrderBudget\Business\Resetter\OrderBudgetResetterInterface;
use FondOfOryx\Zed\OrderBudget\Business\Writer\OrderBudgetWriterInterface;
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
     * @var \FondOfOryx\Zed\OrderBudget\Business\Writer\OrderBudgetWriterInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderBudgetWriterMock;

    /**
     * @var \Generated\Shared\Transfer\OrderBudgetTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderBudgetTransferMock;

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

        $this->facade = new OrderBudgetFacade();
        $this->facade->setFactory($this->factoryMock);
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
            $this->facade->createOrderBudget()
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
}
