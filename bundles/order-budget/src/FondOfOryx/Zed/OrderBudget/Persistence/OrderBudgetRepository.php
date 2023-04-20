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
     * @return array<\Generated\Shared\Transfer\OrderBudgetTransfer>
     */
    public function findAllOrderBudgets(): array
    {
        /** @var \Propel\Runtime\Collection\ObjectCollection $fooOrderBudgetCollection */
        $fooOrderBudgetCollection = $this->getFactory()
            ->createFooOrderBudgetQuery()
            ->find();

        return $this->getFactory()
            ->createOrderBudgetMapper()
            ->mapEntityCollectionToTransfers(
                $fooOrderBudgetCollection,
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
                $entity,
            );
    }
}
