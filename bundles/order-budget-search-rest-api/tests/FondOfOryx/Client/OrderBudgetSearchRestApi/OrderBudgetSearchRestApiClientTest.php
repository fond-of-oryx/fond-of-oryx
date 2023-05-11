<?php

namespace FondOfOryx\Client\OrderBudgetSearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\OrderBudgetSearchRestApi\Zed\OrderBudgetSearchRestApiStubInterface;
use Generated\Shared\Transfer\OrderBudgetListTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class OrderBudgetSearchRestApiClientTest extends Unit
{
    /**
     * @var (\FondOfOryx\Client\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiFactory&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetSearchRestApiFactory|MockObject $factoryMock;

    /**
     * @var (\FondOfOryx\Client\OrderBudgetSearchRestApi\Zed\OrderBudgetSearchRestApiStubInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|OrderBudgetSearchRestApiStubInterface $zedStubMock;

    /**
     * @var (\Generated\Shared\Transfer\OrderBudgetListTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetListTransfer|MockObject $orderBudgetListTransferMock;

    /**
     * @var \FondOfOryx\Client\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiClient
     */
    protected OrderBudgetSearchRestApiClient $client;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(OrderBudgetSearchRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedStubMock = $this->getMockBuilder(OrderBudgetSearchRestApiStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetListTransferMock = $this->getMockBuilder(OrderBudgetListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->client = new OrderBudgetSearchRestApiClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testFindOrderBudgets(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createZedOrderBudgetSearchRestApiStub')
            ->willReturn($this->zedStubMock);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('findOrderBudgets')
            ->with($this->orderBudgetListTransferMock)
            ->willReturn($this->orderBudgetListTransferMock);

        static::assertEquals(
            $this->orderBudgetListTransferMock,
            $this->client->findOrderBudgets($this->orderBudgetListTransferMock),
        );
    }
}
