<?php

namespace FondOfOryx\Zed\OrderBudget\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\OrderBudgetTransfer;
use Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudget;
use Propel\Runtime\Collection\ObjectCollection;

interface OrderBudgetMapperInterface
{
    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $entityCollection
     *
     * @return \Generated\Shared\Transfer\OrderBudgetTransfer[]
     */
    public function mapEntityCollectionToTransfers(
        ObjectCollection $entityCollection
    ): array;

    /**
     * @param \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudget $entity
     *
     * @return \Generated\Shared\Transfer\OrderBudgetTransfer
     */
    public function mapEntityToTransfer(FooOrderBudget $entity): OrderBudgetTransfer;

    /**
     * @param \Generated\Shared\Transfer\OrderBudgetTransfer $transfer
     *
     * @return \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudget
     */
    public function mapTransferToEntity(OrderBudgetTransfer $transfer): FooOrderBudget;
}
