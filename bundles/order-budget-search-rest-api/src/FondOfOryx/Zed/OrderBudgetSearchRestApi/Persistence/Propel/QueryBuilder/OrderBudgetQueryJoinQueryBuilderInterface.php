<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\Propel\QueryBuilder;

use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery;

interface OrderBudgetQueryJoinQueryBuilderInterface
{
    /**
     * @param \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery $query
     * @param \Generated\Shared\Transfer\QueryJoinCollectionTransfer $queryJoinCollectionTransfer
     *
     * @return \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery
     */
    public function addQueryFilters(
        FooOrderBudgetQuery $query,
        QueryJoinCollectionTransfer $queryJoinCollectionTransfer
    ): FooOrderBudgetQuery;
}
