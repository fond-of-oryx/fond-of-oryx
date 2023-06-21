<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Business\Reader;

use ArrayObject;
use Generated\Shared\Transfer\OrderBudgetListTransfer;

interface OrderBudgetReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return \Generated\Shared\Transfer\OrderBudgetListTransfer
     */
    public function findByOrderBudgetList(OrderBudgetListTransfer $orderBudgetListTransfer): OrderBudgetListTransfer;

    /**
     * @param array<int> $orderBudgetIds
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\OrderBudgetTransfer>
     */
    public function findByOrderBudgetIds(array $orderBudgetIds): ArrayObject;
}
