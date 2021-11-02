<?php

namespace FondOfOryx\Zed\OrderBudget\Persistence;

use Generated\Shared\Transfer\OrderBudgetHistoryTransfer;
use Generated\Shared\Transfer\OrderBudgetTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetPersistenceFactory getFactory()
 */
class OrderBudgetEntityManager extends AbstractEntityManager implements OrderBudgetEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\OrderBudgetTransfer $orderBudgetTransfer
     *
     * @return \Generated\Shared\Transfer\OrderBudgetTransfer
     */
    public function createOrderBudget(OrderBudgetTransfer $orderBudgetTransfer): OrderBudgetTransfer
    {
        $orderBudgetMapper = $this->getFactory()
            ->createOrderBudgetMapper();

        $entity = $orderBudgetMapper->mapTransferToEntity($orderBudgetTransfer);

        $entity->save();

        return $orderBudgetMapper->mapEntityToTransfer($entity);
    }

    /**
     * @param \Generated\Shared\Transfer\OrderBudgetTransfer $orderBudgetTransfer
     *
     * @return void
     */
    public function updateOrderBudget(OrderBudgetTransfer $orderBudgetTransfer): void
    {
        $orderBudgetTransfer->requireIdOrderBudget();

        $query = $this->getFactory()->createFooOrderBudgetQuery();

        $entity = $query->findOneByIdOrderBudget($orderBudgetTransfer->getIdOrderBudget());

        if ($entity === null) {
            return;
        }

        $entity->fromArray($orderBudgetTransfer->toArray(true));

        $entity->save();
    }

    /**
     * @param \Generated\Shared\Transfer\OrderBudgetHistoryTransfer $orderBudgetHistoryTransfer
     *
     * @return \Generated\Shared\Transfer\OrderBudgetHistoryTransfer
     */
    public function createOrderBudgetHistory(
        OrderBudgetHistoryTransfer $orderBudgetHistoryTransfer
    ): OrderBudgetHistoryTransfer {
        $entity = $this->getFactory()
            ->createOrderBudgetHistoryMapper()
            ->mapTransferToEntity($orderBudgetHistoryTransfer);

        $entity->save();

        return $orderBudgetHistoryTransfer->setIdOrderBudgetHistory(
            $entity->getIdOrderBudgetHistory(),
        );
    }
}
