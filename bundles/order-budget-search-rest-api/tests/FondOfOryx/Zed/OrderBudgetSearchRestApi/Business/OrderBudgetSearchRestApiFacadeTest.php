<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\Business\Reader\OrderBudgetReaderInterface;
use Generated\Shared\Transfer\OrderBudgetListTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class OrderBudgetSearchRestApiFacadeTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\OrderBudgetSearchRestApi\Business\OrderBudgetSearchRestApiBusinessFactory&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|OrderBudgetSearchRestApiBusinessFactory $factoryMock;

    /**
     * @var (\FondOfOryx\Zed\OrderBudgetSearchRestApi\Business\Reader\OrderBudgetReaderInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|OrderBudgetReaderInterface $orderBudgetReaderMock;

    /**
     * @var (\Generated\Shared\Transfer\OrderBudgetListTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetListTransfer|MockObject $orderBudgetListTransferMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudgetSearchRestApi\Business\OrderBudgetSearchRestApiFacade
     */
    protected OrderBudgetSearchRestApiFacade $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(OrderBudgetSearchRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetReaderMock = $this->getMockBuilder(OrderBudgetReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetListTransferMock = $this->getMockBuilder(OrderBudgetListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new OrderBudgetSearchRestApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testFindOrderBudgets(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createOrderBudgetReader')
            ->willReturn($this->orderBudgetReaderMock);

        $this->orderBudgetReaderMock->expects(static::atLeastOnce())
            ->method('findByOrderBudgetList')
            ->with($this->orderBudgetListTransferMock)
            ->willReturn($this->orderBudgetListTransferMock);

        static::assertEquals(
            $this->orderBudgetListTransferMock,
            $this->facade->findOrderBudgets($this->orderBudgetListTransferMock),
        );
    }
}
