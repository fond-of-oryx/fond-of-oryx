<?php

namespace FondOfOryx\Client\OrderBudgetSearchRestApi\Zed;

use FondOfOryx\Client\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\OrderBudgetListTransfer;

class OrderBudgetSearchRestApiStub implements OrderBudgetSearchRestApiStubInterface
{
    /**
     * @var string
     */
    public const URL_FIND_ORDER_BUDGETS = '/order-budget-search-rest-api/gateway/find-order-budgets';

    /**
     * @var \FondOfOryx\Client\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToZedRequestClientInterface
     */
    protected OrderBudgetSearchRestApiToZedRequestClientInterface $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(
        OrderBudgetSearchRestApiToZedRequestClientInterface $zedRequestClient
    ) {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return \Generated\Shared\Transfer\OrderBudgetListTransfer
     */
    public function findOrderBudgets(OrderBudgetListTransfer $orderBudgetListTransfer): OrderBudgetListTransfer
    {
        /** @var \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer */
        $orderBudgetListTransfer = $this->zedRequestClient->call(
            static::URL_FIND_ORDER_BUDGETS,
            $orderBudgetListTransfer,
        );

        return $orderBudgetListTransfer;
    }
}
