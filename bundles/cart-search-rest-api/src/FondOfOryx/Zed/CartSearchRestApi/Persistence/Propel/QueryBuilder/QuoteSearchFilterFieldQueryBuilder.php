<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Persistence\Propel\QueryBuilder;

use FondOfOryx\Zed\CartSearchRestApi\CartSearchRestApiConfig;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QuoteListTransfer;
use Orm\Zed\Quote\Persistence\Base\SpyQuoteQuery;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * @codeCoverageIgnore
 */
class QuoteSearchFilterFieldQueryBuilder implements QuoteSearchFilterFieldQueryBuilderInterface
{
    /**
     * @var string
     */
    protected const FILTER_FIELD_TYPE_ORDER_BY = 'orderBy';

    /**
     * @var string
     */
    protected const DELIMITER_ORDER_BY = '::';

    /**
     * @var \FondOfOryx\Zed\CartSearchRestApi\CartSearchRestApiConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\CartSearchRestApi\CartSearchRestApiConfig $config
     */
    public function __construct(CartSearchRestApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Orm\Zed\Quote\Persistence\Base\SpyQuoteQuery $query
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     *
     * @return \Orm\Zed\Quote\Persistence\Base\SpyQuoteQuery
     */
    public function addQueryFilters(SpyQuoteQuery $query, QuoteListTransfer $quoteListTransfer): SpyQuoteQuery
    {
        foreach ($quoteListTransfer->getFilterFields() as $filterFieldTransfer) {
            $query = $this->addQueryFilter($query, $filterFieldTransfer);
        }

        return $query;
    }

    /**
     * @param \Orm\Zed\Quote\Persistence\Base\SpyQuoteQuery $query
     * @param \Generated\Shared\Transfer\FilterFieldTransfer $filterFieldTransfer
     *
     * @return \Orm\Zed\Quote\Persistence\Base\SpyQuoteQuery
     */
    protected function addQueryFilter(
        SpyQuoteQuery $query,
        FilterFieldTransfer $filterFieldTransfer
    ): SpyQuoteQuery {
        $filterFieldType = $filterFieldTransfer->getType();

        if (isset($this->config->getFilterFieldTypeMapping()[$filterFieldType])) {
            $query->add(
                $this->config->getFilterFieldTypeMapping()[$filterFieldType],
                $filterFieldTransfer->getValue(),
                Criteria::EQUAL,
            );
        }

        if ($filterFieldType === static::FILTER_FIELD_TYPE_ORDER_BY) {
            return $this->addOrderByFilter(
                $query,
                $filterFieldTransfer,
            );
        }

        return $query;
    }

    /**
     * @param \Orm\Zed\Quote\Persistence\Base\SpyQuoteQuery $query
     * @param \Generated\Shared\Transfer\FilterFieldTransfer $filterFieldTransfer
     *
     * @return \Orm\Zed\Quote\Persistence\Base\SpyQuoteQuery
     */
    protected function addOrderByFilter(
        SpyQuoteQuery $query,
        FilterFieldTransfer $filterFieldTransfer
    ): SpyQuoteQuery {
        [$orderColumn, $orderDirection] = explode(static::DELIMITER_ORDER_BY, $filterFieldTransfer->getValue());

        if ($orderColumn) {
            $query->orderBy($orderColumn, $orderDirection);
        }

        return $query;
    }
}
