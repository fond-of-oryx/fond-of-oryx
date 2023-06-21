<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Business\Reader;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\Dependency\Facade\OrderBudgetSearchRestApiToOrderBudgetFacadeInterface;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\OrderBudgetSearchRestApiRepositoryInterface;
use FondOfOryx\Zed\OrderBudgetSearchRestApiExtension\Dependency\Plugin\SearchOrderBudgetQueryExpanderPluginInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Generated\Shared\Transfer\OrderBudgetTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class OrderBudgetReaderTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\OrderBudgetSearchRestApiRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|OrderBudgetSearchRestApiRepositoryInterface $repositoryMock;

    /**
     * @var (\FondOfOryx\Zed\OrderBudgetSearchRestApi\Dependency\Facade\OrderBudgetSearchRestApiToOrderBudgetFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetSearchRestApiToOrderBudgetFacadeInterface|MockObject $orderBudgetFacadeMock;

    /**
     * @var array<(\FondOfOryx\Zed\OrderBudgetSearchRestApiExtension\Dependency\Plugin\SearchOrderBudgetQueryExpanderPluginInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $searchOrderBudgetQueryExpanderPluginMocks;

    /**
     * @var array<(\Generated\Shared\Transfer\OrderBudgetTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $orderBudgetTransferMocks;

    /**
     * @var (\Generated\Shared\Transfer\OrderBudgetListTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetListTransfer|MockObject $orderBudgetListTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\FilterFieldTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|FilterFieldTransfer $filterFieldTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\QueryJoinCollectionTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|QueryJoinCollectionTransfer $queryJoinCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudgetSearchRestApi\Business\Reader\OrderBudgetReader
     */
    protected OrderBudgetReader $orderBudgetReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(OrderBudgetSearchRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetFacadeMock = $this->getMockBuilder(OrderBudgetSearchRestApiToOrderBudgetFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchOrderBudgetQueryExpanderPluginMocks = [
            $this->getMockBuilder(SearchOrderBudgetQueryExpanderPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(SearchOrderBudgetQueryExpanderPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->orderBudgetTransferMocks = [
            $this->getMockBuilder(OrderBudgetTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(OrderBudgetTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->orderBudgetListTransferMock = $this->getMockBuilder(OrderBudgetListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldTransferMock = $this->getMockBuilder(FilterFieldTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryJoinCollectionTransferMock = $this->getMockBuilder(QueryJoinCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetReader = new OrderBudgetReader(
            $this->repositoryMock,
            $this->orderBudgetFacadeMock,
            $this->searchOrderBudgetQueryExpanderPluginMocks,
        );
    }

    /**
     * @return void
     */
    public function testFindByOrderBudgetIds(): void
    {
        $orderBudgetIds = [1, 3, 5];

        $this->orderBudgetFacadeMock->expects(static::atLeastOnce())
            ->method('findOrderBudgetsByOrderBudgetIds')
            ->with($orderBudgetIds)
            ->willReturn($this->orderBudgetTransferMocks);

        static::assertEquals(
            $this->orderBudgetTransferMocks,
            $this->orderBudgetReader->findByOrderBudgetIds($orderBudgetIds)->getArrayCopy(),
        );
    }

    /**
     * @return void
     */
    public function testFindOrderBudgetList(): void
    {
        $idOrderBudget = 10;
        $filterFieldTransferMocks = [
            $this->filterFieldTransferMock,
        ];

        $this->orderBudgetListTransferMock->expects(static::atLeastOnce())
            ->method('getFilterFields')
            ->willReturn(new ArrayObject($filterFieldTransferMocks));

        $this->searchOrderBudgetQueryExpanderPluginMocks[0]->expects(static::atLeastOnce())
            ->method('isApplicable')
            ->with($filterFieldTransferMocks)
            ->willReturn(true);

        $this->searchOrderBudgetQueryExpanderPluginMocks[0]->expects(static::atLeastOnce())
            ->method('expand')
            ->with(
                $filterFieldTransferMocks,
                static::callback(
                    static function (QueryJoinCollectionTransfer $queryJoinCollectionTransfer) {
                        return $queryJoinCollectionTransfer->getQueryJoins()->count() === 0;
                    },
                ),
            )->willReturn($this->queryJoinCollectionTransferMock);

        $this->searchOrderBudgetQueryExpanderPluginMocks[1]->expects(static::atLeastOnce())
            ->method('isApplicable')
            ->with($filterFieldTransferMocks)
            ->willReturn(false);

        $this->searchOrderBudgetQueryExpanderPluginMocks[1]->expects(static::never())
            ->method('expand');

        $this->orderBudgetListTransferMock->expects(static::atLeastOnce())
            ->method('setQueryJoins')
            ->with($this->queryJoinCollectionTransferMock)
            ->willReturn($this->orderBudgetListTransferMock);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findOrderBudgets')
            ->with($this->orderBudgetListTransferMock)
            ->willReturn($this->orderBudgetListTransferMock);

        $this->orderBudgetListTransferMock->expects(static::atLeastOnce())
            ->method('getOrderBudgets')
            ->willReturn(new ArrayObject([$this->orderBudgetTransferMocks[0]]));

        $this->orderBudgetTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdOrderBudget')
            ->willReturn($idOrderBudget);

        $this->orderBudgetFacadeMock->expects(static::atLeastOnce())
            ->method('findOrderBudgetsByOrderBudgetIds')
            ->with([$idOrderBudget])
            ->willReturn([$this->orderBudgetTransferMocks[0]]);

        static::assertEquals(
            $this->orderBudgetListTransferMock,
            $this->orderBudgetReader->findByOrderBudgetList($this->orderBudgetListTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testFindOrderBudgetListWithoutResult(): void
    {
        $idOrderBudget = 10;
        $filterFieldTransferMocks = [
            $this->filterFieldTransferMock,
        ];

        $this->orderBudgetListTransferMock->expects(static::atLeastOnce())
            ->method('getFilterFields')
            ->willReturn(new ArrayObject($filterFieldTransferMocks));

        $this->searchOrderBudgetQueryExpanderPluginMocks[0]->expects(static::atLeastOnce())
            ->method('isApplicable')
            ->with($filterFieldTransferMocks)
            ->willReturn(true);

        $this->searchOrderBudgetQueryExpanderPluginMocks[0]->expects(static::atLeastOnce())
            ->method('expand')
            ->with(
                $filterFieldTransferMocks,
                static::callback(
                    static function (QueryJoinCollectionTransfer $queryJoinCollectionTransfer) {
                        return $queryJoinCollectionTransfer->getQueryJoins()->count() === 0;
                    },
                ),
            )->willReturn($this->queryJoinCollectionTransferMock);

        $this->searchOrderBudgetQueryExpanderPluginMocks[1]->expects(static::atLeastOnce())
            ->method('isApplicable')
            ->with($filterFieldTransferMocks)
            ->willReturn(false);

        $this->searchOrderBudgetQueryExpanderPluginMocks[1]->expects(static::never())
            ->method('expand');

        $this->orderBudgetListTransferMock->expects(static::atLeastOnce())
            ->method('setQueryJoins')
            ->with($this->queryJoinCollectionTransferMock)
            ->willReturn($this->orderBudgetListTransferMock);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findOrderBudgets')
            ->with($this->orderBudgetListTransferMock)
            ->willReturn($this->orderBudgetListTransferMock);

        $this->orderBudgetListTransferMock->expects(static::atLeastOnce())
            ->method('getOrderBudgets')
            ->willReturn(new ArrayObject());

        $this->orderBudgetFacadeMock->expects(static::never())
            ->method('findOrderBudgetsByOrderBudgetIds');

        static::assertEquals(
            $this->orderBudgetListTransferMock,
            $this->orderBudgetReader->findByOrderBudgetList($this->orderBudgetListTransferMock),
        );
    }
}
