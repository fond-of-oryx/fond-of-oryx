<?php

namespace FondOfOryx\Zed\OrderBudget\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\OrderBudgetHistoryTransfer;
use Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetHistory as BaseFooOrderBudgetHistory;
use Orm\Zed\OrderBudget\Persistence\FooOrderBudgetHistory;

class OrderBudgetHistoryMapper implements OrderBudgetHistoryMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\OrderBudgetHistoryTransfer $transfer
     *
     * @return \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetHistory
     */
    public function mapTransferToEntity(OrderBudgetHistoryTransfer $transfer): BaseFooOrderBudgetHistory
    {
        $entity = new FooOrderBudgetHistory();

        $entity->fromArray($transfer->toArray());

        return $entity;
    }
}
