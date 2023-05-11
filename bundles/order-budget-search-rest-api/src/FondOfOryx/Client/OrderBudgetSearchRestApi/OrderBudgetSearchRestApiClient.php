<?php

namespace FondOfOryx\Client\OrderBudgetSearchRestApi;

use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiFactory getFactory()
 */
class OrderBudgetSearchRestApiClient extends AbstractClient implements OrderBudgetSearchRestApiClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return \Generated\Shared\Transfer\OrderBudgetListTransfer
     */
    public function findOrderBudgets(OrderBudgetListTransfer $orderBudgetListTransfer): OrderBudgetListTransfer
    {
        return $this->getFactory()
            ->createZedOrderBudgetSearchRestApiStub()
            ->findOrderBudgets($orderBudgetListTransfer);
    }
}
