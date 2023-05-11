<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\Propel\QueryBuilder;

use FondOfOryx\Shared\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConstants;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * @codeCoverageIgnore
 */
class OrderBudgetSearchFilterFieldQueryBuilder implements OrderBudgetSearchFilterFieldQueryBuilderInterface
{
    /**
     * @var string
     */
    public const CONDITION_GROUP_ALL = 'CONDITION_GROUP_ALL';

    /**
     * @var \FondOfOryx\Zed\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig
     */
    protected OrderBudgetSearchRestApiConfig $config;

    /**
     * @param \FondOfOryx\Zed\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig $config
     */
    public function __construct(OrderBudgetSearchRestApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery $query
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery
     */
    public function addQueryFilters(
        FooOrderBudgetQuery $query,
        OrderBudgetListTransfer $orderBudgetListTransfer
    ): FooOrderBudgetQuery {
        foreach ($orderBudgetListTransfer->getFilterFields() as $filterFieldTransfer) {
            $query = $this->addQueryFilter($query, $filterFieldTransfer);
        }

        return $query;
    }

    /**
     * @param \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery $query
     * @param \Generated\Shared\Transfer\FilterFieldTransfer $filterFieldTransfer
     *
     * @return \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery
     */
    protected function addQueryFilter(
        FooOrderBudgetQuery $query,
        FilterFieldTransfer $filterFieldTransfer
    ): FooOrderBudgetQuery {
        $filterFieldType = $filterFieldTransfer->getType();

        if ($filterFieldType === OrderBudgetSearchRestApiConstants::FILTER_FIELD_TYPE_ALL) {
            return $this->addAllSearchTypeFilter($query, $filterFieldTransfer);
        }

        if (isset($this->config->getFilterFieldTypeMapping()[$filterFieldType])) {
            return $query->add(
                $this->config->getFilterFieldTypeMapping()[$filterFieldType],
                $filterFieldTransfer->getValue(),
                Criteria::EQUAL,
            );
        }

        if ($filterFieldType === OrderBudgetSearchRestApiConstants::FILTER_FIELD_TYPE_ORDER_BY) {
            return $this->addOrderByFilter(
                $query,
                $filterFieldTransfer,
            );
        }

        return $query;
    }

    /**
     * @param \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery $query
     * @param \Generated\Shared\Transfer\FilterFieldTransfer $filterFieldTransfer
     *
     * @return \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery
     */
    protected function addAllSearchTypeFilter(
        FooOrderBudgetQuery $query,
        FilterFieldTransfer $filterFieldTransfer
    ): FooOrderBudgetQuery {
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
     * @param \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery $query
     * @param \Generated\Shared\Transfer\FilterFieldTransfer $filterFieldTransfer
     *
     * @return \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery
     */
    protected function addOrderByFilter(
        FooOrderBudgetQuery $query,
        FilterFieldTransfer $filterFieldTransfer
    ): FooOrderBudgetQuery {
        [$orderColumn, $orderDirection] = explode(
            OrderBudgetSearchRestApiConstants::DELIMITER_ORDER_BY,
            $filterFieldTransfer->getValue(),
        );

        if ($orderColumn) {
            $query->orderBy($orderColumn, $orderDirection);
        }

        return $query;
    }
}
