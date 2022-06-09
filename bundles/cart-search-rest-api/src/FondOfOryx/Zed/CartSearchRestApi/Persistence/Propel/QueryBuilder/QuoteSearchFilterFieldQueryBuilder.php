<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Persistence\Propel\QueryBuilder;

use FondOfOryx\Shared\CartSearchRestApi\CartSearchRestApiConstants;
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
    public const CONDITION_GROUP_ALL = 'CONDITION_GROUP_ALL';

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

        if ($filterFieldType === CartSearchRestApiConstants::FILTER_FIELD_TYPE_ALL) {
            return $this->addAllSearchTypeFilter($query, $filterFieldTransfer);
        }

        if (isset($this->config->getFilterFieldTypeMapping()[$filterFieldType])) {
            return $query->add(
                $this->config->getFilterFieldTypeMapping()[$filterFieldType],
                $filterFieldTransfer->getValue(),
                Criteria::EQUAL,
            );
        }

        if ($filterFieldType === CartSearchRestApiConstants::FILTER_FIELD_TYPE_ORDER_BY) {
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
    protected function addAllSearchTypeFilter(
        SpyQuoteQuery $query,
        FilterFieldTransfer $filterFieldTransfer
    ): SpyQuoteQuery {
        $conditions = [];

        foreach ($this->config->getFilterFieldTypeMapping() as $column) {
            $conditionName = uniqid($column, true);

            $query->addCond(
                $conditionName,
                $column,
                $this->generateLikePattern($filterFieldTransfer->getValue()),
                Criteria::ILIKE,
            );

            $conditions[] = $conditionName;
        }

        $query->combine(
            $conditions,
            Criteria::LOGICAL_OR,
            static::CONDITION_GROUP_ALL,
        );

        return $query;
    }

    /**
     * @param string $value
     *
     * @return string
     */
    protected function generateLikePattern(string $value): string
    {
        return sprintf('%%%s%%', $value);
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
        [$orderColumn, $orderDirection] = explode(CartSearchRestApiConstants::DELIMITER_ORDER_BY, $filterFieldTransfer->getValue());

        if ($orderColumn) {
            $query->orderBy($orderColumn, $orderDirection);
        }

        return $query;
    }
}
