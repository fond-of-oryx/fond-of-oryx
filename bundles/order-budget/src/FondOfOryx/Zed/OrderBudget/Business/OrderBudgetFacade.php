<?php

namespace FondOfOryx\Zed\OrderBudget\Business;

use Generated\Shared\Transfer\OrderBudgetTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\OrderBudget\Business\OrderBudgetBusinessFactory getFactory()
 */
class OrderBudgetFacade extends AbstractFacade implements OrderBudgetFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return void
     */
    public function resetOrderBudgets(): void
    {
        $this->getFactory()->createOrderBudgetResetter()->resetAll();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int|null $budget
     *
     * @return \Generated\Shared\Transfer\OrderBudgetTransfer
     */
    public function createOrderBudget(?int $budget = null): OrderBudgetTransfer
    {
        return $this->getFactory()->createOrderBudgetWriter()->create($budget);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderBudgetTransfer $orderBudgetTransfer
     *
     * @return void
     */
    public function updateOrderBudget(OrderBudgetTransfer $orderBudgetTransfer): void
    {
        $this->getFactory()->createOrderBudgetWriter()->update($orderBudgetTransfer);
    }
}
