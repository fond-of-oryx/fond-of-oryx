<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Generated\Shared\Transfer\RestOrderBudgetSearchPaginationTransfer;

interface RestOrderBudgetSearchPaginationMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return \Generated\Shared\Transfer\RestOrderBudgetSearchPaginationTransfer
     */
    public function fromOrderBudgetList(
        OrderBudgetListTransfer $orderBudgetListTransfer
    ): RestOrderBudgetSearchPaginationTransfer;
}
