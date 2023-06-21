<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OrderBudget\Business\OrderBudgetFacadeInterface;
use Generated\Shared\Transfer\OrderBudgetTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class OrderBudgetSearchRestApiToOrderBudgetFacadeBridgeTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\OrderBudget\Business\OrderBudgetFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|OrderBudgetFacadeInterface $facadeMock;

    /**
     * @var (\Generated\Shared\Transfer\OrderBudgetTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetTransfer|MockObject $orderBudgetTransferMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudgetSearchRestApi\Dependency\Facade\OrderBudgetSearchRestApiToOrderBudgetFacadeBridge
     */
    protected OrderBudgetSearchRestApiToOrderBudgetFacadeBridge $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(OrderBudgetFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetTransferMock = $this->getMockBuilder(OrderBudgetTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new OrderBudgetSearchRestApiToOrderBudgetFacadeBridge($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testFindOrderBudgetsByOrderBudgetIds(): void
    {
        $orderBudgetIds = [1];
        $orderBudgetTransferMocks = [$this->orderBudgetTransferMock];

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('findOrderBudgetsByOrderBudgetIds')
            ->with($orderBudgetIds)
            ->willReturn($orderBudgetTransferMocks);

        static::assertEquals(
            $orderBudgetTransferMocks,
            $this->bridge->findOrderBudgetsByOrderBudgetIds($orderBudgetIds),
        );
    }
}
