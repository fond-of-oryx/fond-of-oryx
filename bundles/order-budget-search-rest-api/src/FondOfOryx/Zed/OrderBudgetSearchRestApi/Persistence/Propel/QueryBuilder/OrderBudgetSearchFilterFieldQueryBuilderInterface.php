<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\Propel\QueryBuilder;

use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery;

interface OrderBudgetSearchFilterFieldQueryBuilderInterface
{
    /**
     * @param \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery $query
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery
     */
    public function addQueryFilters(
        FooOrderBudgetQuery $query,
        OrderBudgetListTransfer $orderBudgetListTransfer
    ): FooOrderBudgetQuery;
}
