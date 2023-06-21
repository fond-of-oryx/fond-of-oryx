<?php

namespace FondOfOryx\Client\OrderBudgetSearchRestApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\OrderBudgetListTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class OrderBudgetSearchRestApiStubTest extends Unit
{
    /**
     * @var (\Generated\Shared\Transfer\OrderBudgetListTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetListTransfer|MockObject $orderBudgetListTransferMock;

    /**
     * @var (\FondOfOryx\Client\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToZedRequestClientInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetSearchRestApiToZedRequestClientInterface|MockObject $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\OrderBudgetSearchRestApi\Zed\OrderBudgetSearchRestApiStub
     */
    protected OrderBudgetSearchRestApiStub $stub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->orderBudgetListTransferMock = $this->getMockBuilder(OrderBudgetListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(OrderBudgetSearchRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stub = new OrderBudgetSearchRestApiStub($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testFindOrderBudgets(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                OrderBudgetSearchRestApiStub::URL_FIND_ORDER_BUDGETS,
                $this->orderBudgetListTransferMock,
            )->willReturn($this->orderBudgetListTransferMock);

        static::assertEquals(
            $this->orderBudgetListTransferMock,
            $this->stub->findOrderBudgets($this->orderBudgetListTransferMock),
        );
    }
}
