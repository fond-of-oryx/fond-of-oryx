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
     * @param array<int> $orderBudgetIds
     *
     * @return void
     */
    public function resetOrderBudgets(array $orderBudgetIds = []): void
    {
        $this->getFactory()->createOrderBudgetResetter()->resetMultiple($orderBudgetIds);
    }

    /**
     * Specification:
     * - Removes old data from history
     *
     * @api
     *
     * @return void
     */
    public function cleanupOrderBudgetHistory(): void
    {
        $this->getFactory()->createOrderBudgetHistoryCleaner()->clean();
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

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idOrderBudget
     *
     * @return \Generated\Shared\Transfer\OrderBudgetTransfer|null
     */
    public function findOrderBudgetByIdOrderBudget(int $idOrderBudget): ?OrderBudgetTransfer
    {
        return $this->getRepository()->findOrderBudgetByIdOrderBudget($idOrderBudget);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $orderBudgetIds
     *
     * @return array<\Generated\Shared\Transfer\OrderBudgetTransfer>
     */
    public function findOrderBudgetsByOrderBudgetIds(array $orderBudgetIds): array
    {
        return $this->getRepository()->findOrderBudgetsByOrderBudgetIds($orderBudgetIds);
    }
}
