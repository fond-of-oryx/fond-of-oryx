<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Persistence\Propel\QueryBuilder;

use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Orm\Zed\Quote\Persistence\SpyQuoteQuery;

interface QuoteQueryJoinQueryBuilderInterface
{
    /**
     * @param \Orm\Zed\Quote\Persistence\SpyQuoteQuery $query
     * @param \Generated\Shared\Transfer\QueryJoinCollectionTransfer $queryJoinCollectionTransfer
     *
     * @return \Orm\Zed\Quote\Persistence\SpyQuoteQuery
     */
    public function addQueryFilters(
        SpyQuoteQuery $query,
        QueryJoinCollectionTransfer $queryJoinCollectionTransfer
    ): SpyQuoteQuery;
}
