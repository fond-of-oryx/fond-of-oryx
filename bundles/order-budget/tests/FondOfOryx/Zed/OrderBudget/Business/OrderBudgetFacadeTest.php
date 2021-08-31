<?php

namespace FondOfOryx\Zed\OrderBudget\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OrderBudget\Business\Resetter\OrderBudgetResetterInterface;

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
}
