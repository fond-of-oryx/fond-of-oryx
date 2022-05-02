<?php

namespace FondOfOryx\Zed\OrderBudget\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\OrderBudgetTransfer;
use Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudget as BaseFooOrderBudget;
use Orm\Zed\OrderBudget\Persistence\FooOrderBudget;
use Propel\Runtime\Collection\ObjectCollection;

class OrderBudgetMapper implements OrderBudgetMapperInterface
{
    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudget> $entityCollection
     *
     * @return array
     */
    public function mapEntityCollectionToTransfers(ObjectCollection $entityCollection): array
    {
        $transfers = [];

        foreach ($entityCollection as $entity) {
            $transfers[] = $this->mapEntityToTransfer($entity);
        }

        return $transfers;
    }

    /**
     * @param \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudget $entity
     *
     * @return \Generated\Shared\Transfer\OrderBudgetTransfer
     */
    public function mapEntityToTransfer(BaseFooOrderBudget $entity): OrderBudgetTransfer
    {
        return (new OrderBudgetTransfer())->fromArray($entity->toArray(), false);
    }

    /**
     * @param \Generated\Shared\Transfer\OrderBudgetTransfer $transfer
     *
     * @return \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudget
     */
    public function mapTransferToEntity(OrderBudgetTransfer $transfer): BaseFooOrderBudget
    {
        $entity = new FooOrderBudget();

        $entity->fromArray($transfer->toArray());

        return $entity;
    }
}
