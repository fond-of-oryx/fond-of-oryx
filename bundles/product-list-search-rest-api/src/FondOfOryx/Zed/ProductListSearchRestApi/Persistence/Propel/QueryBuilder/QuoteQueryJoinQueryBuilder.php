<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Persistence\Propel\QueryBuilder;

use ArrayObject;
use FondOfOryx\Zed\ProductListSearchRestApi\Dependency\Service\ProductListSearchRestApiToUtilEncodingServiceInterface;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Generated\Shared\Transfer\QueryWhereConditionTransfer;
use Orm\Zed\ProductList\Persistence\SpyProductListQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\Criterion\CustomCriterion;

/**
 * @codeCoverageIgnore
 */
class QuoteQueryJoinQueryBuilder implements QuoteQueryJoinQueryBuilderInterface
{
    /**
     * @var string
     */
    protected const CONCAT = 'CONCAT';

    /**
     * @var \FondOfOryx\Zed\ProductListSearchRestApi\Dependency\Service\ProductListSearchRestApiToUtilEncodingServiceInterface
     */
    protected ProductListSearchRestApiToUtilEncodingServiceInterface $utilEncodingService;

    /**
     * @param \FondOfOryx\Zed\ProductListSearchRestApi\Dependency\Service\ProductListSearchRestApiToUtilEncodingServiceInterface $utilEncodingService
     */
    public function __construct(ProductListSearchRestApiToUtilEncodingServiceInterface $utilEncodingService)
    {
        $this->utilEncodingService = $utilEncodingService;
    }

    /**
     * @param \Orm\Zed\ProductList\Persistence\SpyProductListQuery $productListQuery
     * @param \Generated\Shared\Transfer\QueryJoinCollectionTransfer $queryJoinCollectionTransfer
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery
     */
    public function addQueryFilters(
        SpyProductListQuery $productListQuery,
        QueryJoinCollectionTransfer $queryJoinCollectionTransfer
    ): SpyProductListQuery {
        $whereConditionGroups = new ArrayObject();

        foreach ($queryJoinCollectionTransfer->getQueryJoins() as $queryJoinTransfer) {
            $productListQuery = $this->processQueryJoin(
                $productListQuery,
                $queryJoinTransfer,
                $whereConditionGroups,
            );
        }

        if ($whereConditionGroups->count() === 0) {
            return $productListQuery;
        }

        $productListQuery->where($whereConditionGroups->getArrayCopy(), Criteria::LOGICAL_AND);

        return $productListQuery;
    }

    /**
     * @param \Orm\Zed\ProductList\Persistence\SpyProductListQuery $productListQuery
     * @param \Generated\Shared\Transfer\QueryJoinTransfer $queryJoinTransfer
     * @param \ArrayObject $whereConditionGroups
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery
     */
    protected function processQueryJoin(
        SpyProductListQuery $productListQuery,
        QueryJoinTransfer $queryJoinTransfer,
        ArrayObject $whereConditionGroups
    ): SpyProductListQuery {
        $productListQuery = $this->addJoin($productListQuery, $queryJoinTransfer);

        if (count($queryJoinTransfer->getWithColumns()) > 0) {
            $productListQuery = $this->addWithColumns(
                $productListQuery,
                $queryJoinTransfer->getWithColumns(),
            );
        }

        if ($queryJoinTransfer->getWhereConditions()->count() > 0) {
            $productListQuery = $this->addWhereConditionGroup(
                $productListQuery,
                $queryJoinTransfer->getWhereConditions(),
                $whereConditionGroups,
            );
        }

        if ($queryJoinTransfer->getOrderBy() !== null) {
            $productListQuery->orderBy(
                $queryJoinTransfer->getOrderBy(),
                $queryJoinTransfer->getOrderDirection() ?? Criteria::DESC,
            );
        }

        return $productListQuery;
    }

    /**
     * @param \Orm\Zed\ProductList\Persistence\SpyProductListQuery $productListQuery
     * @param array<string> $withColumns
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery
     */
    protected function addWithColumns(
        SpyProductListQuery $productListQuery,
        array $withColumns
    ): SpyProductListQuery {
        foreach ($withColumns as $name => $withColumn) {
            $productListQuery->withColumn($withColumn, $name);
        }

        return $productListQuery;
    }

    /**
     * @param \Orm\Zed\ProductList\Persistence\SpyProductListQuery $productListQuery
     * @param \Generated\Shared\Transfer\QueryJoinTransfer $queryJoinTransfer
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery
     */
    protected function addJoin(
        SpyProductListQuery $productListQuery,
        QueryJoinTransfer $queryJoinTransfer
    ): SpyProductListQuery {
        if ($queryJoinTransfer->getRelation()) {
            return $this->addRelationJoin($productListQuery, $queryJoinTransfer);
        }

        $left = $queryJoinTransfer->getLeft();
        $right = $queryJoinTransfer->getRight();

        if ($left && $right) {
            $productListQuery->addJoin(
                $left,
                $right,
                $queryJoinTransfer->getJoinType() ?? Criteria::LEFT_JOIN,
            );
        }

        return $productListQuery;
    }

    /**
     * @param \Orm\Zed\ProductList\Persistence\SpyProductListQuery $productListQuery
     * @param \Generated\Shared\Transfer\QueryJoinTransfer $queryJoinTransfer
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery
     */
    protected function addRelationJoin(
        SpyProductListQuery $productListQuery,
        QueryJoinTransfer $queryJoinTransfer
    ): SpyProductListQuery {
        $productListQuery->join(
            $queryJoinTransfer->getRelation(),
            $queryJoinTransfer->getJoinType() ?? Criteria::LEFT_JOIN,
        );

        if ($queryJoinTransfer->getCondition()) {
            $productListQuery->addJoinCondition(
                $queryJoinTransfer->getRelation(),
                $queryJoinTransfer->getCondition(),
            );
        }

        return $productListQuery;
    }

    /**
     * @param \Orm\Zed\ProductList\Persistence\SpyProductListQuery $productListQuery
     * @param \ArrayObject $queryWhereConditionTransfers
     * @param \ArrayObject $conditionGroups
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery
     */
    protected function addWhereConditionGroup(
        SpyProductListQuery $productListQuery,
        ArrayObject $queryWhereConditionTransfers,
        ArrayObject $conditionGroups
    ): SpyProductListQuery {
        $conditionGroupName = uniqid('', true);

        $conditions = $this->createWhereConditions($productListQuery, $queryWhereConditionTransfers);

        if ($conditions) {
            $productListQuery->combine(
                $conditions,
                Criteria::LOGICAL_OR,
                $conditionGroupName,
            );

            $conditionGroups->append($conditionGroupName);
        }

        return $productListQuery;
    }

    /**
     * @param \Orm\Zed\ProductList\Persistence\SpyProductListQuery $productListQuery
     * @param \ArrayObject<int, \Generated\Shared\Transfer\QueryWhereConditionTransfer> $queryWhereConditionTransfers
     *
     * @return array<string>
     */
    protected function createWhereConditions(
        SpyProductListQuery $productListQuery,
        ArrayObject $queryWhereConditionTransfers
    ): array {
        $conditions = [];

        foreach ($queryWhereConditionTransfers as $queryWhereConditionTransfer) {
            $conditionName = uniqid($queryWhereConditionTransfer->getColumn(), true);
            $productListQuery = $this
                ->addConditionToQuery($conditionName, $queryWhereConditionTransfer, $productListQuery);

            $combineWithCondition = $queryWhereConditionTransfer->getMergeWithCondition();

            if ($combineWithCondition) {
                $productListQuery->combine(
                    [$combineWithCondition, $conditionName],
                    $queryWhereConditionTransfer->getMergeOperator() ?? Criteria::LOGICAL_OR,
                    $combineWithCondition,
                );

                continue;
            }

            $conditions[] = $conditionName;
        }

        return $conditions;
    }

    /**
     * @param string $conditionName
     * @param \Generated\Shared\Transfer\QueryWhereConditionTransfer $queryWhereConditionTransfer
     * @param \Orm\Zed\ProductList\Persistence\SpyProductListQuery $productListQuery
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery
     */
    protected function addConditionToQuery(
        string $conditionName,
        QueryWhereConditionTransfer $queryWhereConditionTransfer,
        SpyProductListQuery $productListQuery
    ): SpyProductListQuery {
        $column = $queryWhereConditionTransfer->getColumn();
        $value = $queryWhereConditionTransfer->getValue();
        $comparison = $queryWhereConditionTransfer->getComparison() ?? Criteria::LIKE;

        if (mb_strpos($column, static::CONCAT) !== false) {
            return $productListQuery->addCond(
                $conditionName,
                new CustomCriterion(new Criteria(), sprintf('%s%s\'%%%s%%\'', $column, $comparison, $value)),
                null,
                Criteria::CUSTOM,
            );
        }

        if ($comparison === Criteria::IN) {
            return $productListQuery->addCond(
                $conditionName,
                $column,
                $this->utilEncodingService->decodeJson($value, true),
                $comparison,
            );
        }

        return $productListQuery->addCond(
            $conditionName,
            $column,
            $comparison === Criteria::LIKE ? $this->formatFilterValue($value) : $value,
            $comparison,
        );
    }

    /**
     * @param string|null $value
     *
     * @return string
     */
    protected function formatFilterValue(?string $value): string
    {
        return sprintf('%%%s%%', $value);
    }
}
