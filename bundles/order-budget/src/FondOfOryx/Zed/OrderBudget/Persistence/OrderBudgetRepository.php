<?php

namespace FondOfOryx\Zed\OrderBudget\Persistence;

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
}
