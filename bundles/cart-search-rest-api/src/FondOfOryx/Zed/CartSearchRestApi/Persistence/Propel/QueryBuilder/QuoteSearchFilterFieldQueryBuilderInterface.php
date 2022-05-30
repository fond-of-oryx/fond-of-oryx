<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Persistence\Propel\QueryBuilder;

use Generated\Shared\Transfer\QuoteListTransfer;
use Orm\Zed\Quote\Persistence\Base\SpyQuoteQuery;

interface QuoteSearchFilterFieldQueryBuilderInterface
{
    /**
     * @param \Orm\Zed\Quote\Persistence\Base\SpyQuoteQuery $query
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     *
     * @return \Orm\Zed\Quote\Persistence\Base\SpyQuoteQuery
     */
    public function addQueryFilters(
        SpyQuoteQuery $query,
        QuoteListTransfer $quoteListTransfer
    ): SpyQuoteQuery;
}
