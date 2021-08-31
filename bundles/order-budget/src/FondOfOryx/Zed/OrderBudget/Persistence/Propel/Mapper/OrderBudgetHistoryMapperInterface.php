<?php

namespace FondOfOryx\Zed\OrderBudget\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\OrderBudgetHistoryTransfer;
use Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetHistory;

interface OrderBudgetHistoryMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\OrderBudgetHistoryTransfer $transfer
     *
     * @return \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetHistory
     */
    public function mapTransferToEntity(OrderBudgetHistoryTransfer $transfer): FooOrderBudgetHistory;
}
