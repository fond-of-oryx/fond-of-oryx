<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Persistence\Propel\QueryBuilder;

use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Orm\Zed\Quote\Persistence\Base\SpyQuoteQuery;

interface QuoteQueryJoinQueryBuilderInterface
{
    /**
     * @param \Orm\Zed\Quote\Persistence\Base\SpyQuoteQuery $query
     * @param \Generated\Shared\Transfer\QueryJoinCollectionTransfer $queryJoinCollectionTransfer
     *
     * @return \Orm\Zed\Quote\Persistence\Base\SpyQuoteQuery
     */
    public function addQueryFilters(
        SpyQuoteQuery $query,
        QueryJoinCollectionTransfer $queryJoinCollectionTransfer
    ): SpyQuoteQuery;
}
