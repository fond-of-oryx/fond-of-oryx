<?php

namespace FondOfOryx\Zed\OrderBudget\Persistence;

use Generated\Shared\Transfer\OrderBudgetTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetPersistenceFactory getFactory()
 */
class OrderBudgetRepository extends AbstractRepository implements OrderBudgetRepositoryInterface
{
    /**
     * @return \Generated\Shared\Transfer\OrderBudgetTransfer[]
     */
    public function findAllOrderBudgets(): array
    {
        $query = $this->getFactory()
            ->createFooOrderBudgetQuery();

        return $this->getFactory()
            ->createOrderBudgetMapper()
            ->mapEntityCollectionToTransfers(
                $query->find()
            );
    }

    /**
     * @param int $idOrderBudget
     *
     * @return \Generated\Shared\Transfer\OrderBudgetTransfer|null
     */
    public function findOrderBudgetByIdOrderBudget(int $idOrderBudget): ?OrderBudgetTransfer
    {
        $query = $this->getFactory()
            ->createFooOrderBudgetQuery();

        $entity = $query->findOneByIdOrderBudget($idOrderBudget);

        if ($entity === null) {
            return null;
        }

        return $this->getFactory()
            ->createOrderBudgetMapper()
            ->mapEntityToTransfer(
                $entity
            );
    }
}
