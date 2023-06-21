<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Business\Reader;

use ArrayObject;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\Dependency\Facade\OrderBudgetSearchRestApiToOrderBudgetFacadeInterface;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\OrderBudgetSearchRestApiRepositoryInterface;
use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;

class OrderBudgetReader implements OrderBudgetReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\OrderBudgetSearchRestApiRepositoryInterface
     */
    protected OrderBudgetSearchRestApiRepositoryInterface $repository;

    /**
     * @var \FondOfOryx\Zed\OrderBudgetSearchRestApi\Dependency\Facade\OrderBudgetSearchRestApiToOrderBudgetFacadeInterface
     */
    protected OrderBudgetSearchRestApiToOrderBudgetFacadeInterface $orderBudgetFacade;

    /**
     * @var array<\FondOfOryx\Zed\OrderBudgetSearchRestApiExtension\Dependency\Plugin\SearchOrderBudgetQueryExpanderPluginInterface>
     */
    protected array $searchOrderBudgetQueryExpanderPlugins;

    /**
     * @param \FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\OrderBudgetSearchRestApiRepositoryInterface $repository
     * @param \FondOfOryx\Zed\OrderBudgetSearchRestApi\Dependency\Facade\OrderBudgetSearchRestApiToOrderBudgetFacadeInterface $orderBudgetFacade
     * @param array<\FondOfOryx\Zed\OrderBudgetSearchRestApiExtension\Dependency\Plugin\SearchOrderBudgetQueryExpanderPluginInterface> $searchOrderBudgetQueryExpanderPlugins
     */
    public function __construct(
        OrderBudgetSearchRestApiRepositoryInterface $repository,
        OrderBudgetSearchRestApiToOrderBudgetFacadeInterface $orderBudgetFacade,
        array $searchOrderBudgetQueryExpanderPlugins = []
    ) {
        $this->repository = $repository;
        $this->orderBudgetFacade = $orderBudgetFacade;
        $this->searchOrderBudgetQueryExpanderPlugins = $searchOrderBudgetQueryExpanderPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return \Generated\Shared\Transfer\OrderBudgetListTransfer
     */
    public function findByOrderBudgetList(OrderBudgetListTransfer $orderBudgetListTransfer): OrderBudgetListTransfer
    {
        $orderBudgetListTransfer = $this->executeSearchOrderBudgetQueryExpanderPlugins($orderBudgetListTransfer);
        $orderBudgetListTransfer = $this->repository->findOrderBudgets($orderBudgetListTransfer);

        $idOrderBudgetToIndex = [];
        $orderBudgetTransfers = $orderBudgetListTransfer->getOrderBudgets();

        foreach ($orderBudgetTransfers as $index => $orderBudgetTransfer) {
            $idOrderBudgetToIndex[$orderBudgetTransfer->getIdOrderBudget()] = $index;
        }

        if (count($idOrderBudgetToIndex) === 0) {
            return $orderBudgetListTransfer;
        }

        foreach ($this->findByOrderBudgetIds(array_keys($idOrderBudgetToIndex)) as $orderBudgetTransfer) {
            $idOrderBudget = $orderBudgetTransfer->getIdOrderBudget();

            // @codeCoverageIgnoreStart
            if ($idOrderBudget === null || !isset($idOrderBudgetToIndex[$idOrderBudget])) {
                continue;
            }
            // @codeCoverageIgnoreEnd

            $orderBudgetTransfers->offsetSet($idOrderBudgetToIndex[$idOrderBudget], $orderBudgetTransfer);
        }

        return $orderBudgetListTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return \Generated\Shared\Transfer\OrderBudgetListTransfer
     */
    protected function executeSearchOrderBudgetQueryExpanderPlugins(OrderBudgetListTransfer $orderBudgetListTransfer): OrderBudgetListTransfer
    {
        $queryJoinCollectionTransfer = new QueryJoinCollectionTransfer();
        $filterTransfers = $orderBudgetListTransfer->getFilterFields()->getArrayCopy();

        foreach ($this->searchOrderBudgetQueryExpanderPlugins as $searchOrderBudgetQueryExpanderPlugin) {
            if (!$searchOrderBudgetQueryExpanderPlugin->isApplicable($filterTransfers)) {
                continue;
            }

            $queryJoinCollectionTransfer = $searchOrderBudgetQueryExpanderPlugin->expand(
                $filterTransfers,
                $queryJoinCollectionTransfer,
            );
        }

        return $orderBudgetListTransfer->setQueryJoins($queryJoinCollectionTransfer);
    }

    /**
     * @param array<int> $orderBudgetIds
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\OrderBudgetTransfer>
     */
    public function findByOrderBudgetIds(array $orderBudgetIds): ArrayObject
    {
        return new ArrayObject(
            $this->orderBudgetFacade->findOrderBudgetsByOrderBudgetIds($orderBudgetIds),
        );
    }
}
