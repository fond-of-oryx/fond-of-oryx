<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\QueryBuilder;

use FondOfOryx\Shared\CompanyUserSearchRestApi\CompanyUserSearchRestApiConstants;
use FondOfOryx\Zed\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * @codeCoverageIgnore
 */
class CompanyUserSearchFilterFieldQueryBuilder implements CompanyUserSearchFilterFieldQueryBuilderInterface
{
    /**
     * @var string
     */
    public const CONDITION_GROUP_ALL = 'CONDITION_GROUP_ALL';

    /**
     * @var \FondOfOryx\Zed\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig
     */
    protected CompanyUserSearchRestApiConfig $config;

    /**
     * @param \FondOfOryx\Zed\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig $config
     */
    public function __construct(CompanyUserSearchRestApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery $query
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $orderBudgetListTransfer
     *
     * @return \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery
     */
    public function addQueryFilters(
        SpyCompanyUserQuery $query,
        CompanyUserListTransfer $orderBudgetListTransfer
    ): SpyCompanyUserQuery {
        foreach ($orderBudgetListTransfer->getFilterFields() as $filterFieldTransfer) {
            $query = $this->addQueryFilter($query, $filterFieldTransfer);
        }

        return $query;
    }

    /**
     * @param \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery $query
     * @param \Generated\Shared\Transfer\FilterFieldTransfer $filterFieldTransfer
     *
     * @return \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery
     */
    protected function addQueryFilter(
        SpyCompanyUserQuery $query,
        FilterFieldTransfer $filterFieldTransfer
    ): SpyCompanyUserQuery {
        $filterFieldType = $filterFieldTransfer->getType();

        if ($filterFieldType === CompanyUserSearchRestApiConstants::FILTER_FIELD_TYPE_ALL) {
            return $this->addAllSearchTypeFilter($query, $filterFieldTransfer);
        }

        if (isset($this->config->getFilterFieldTypeMapping()[$filterFieldType])) {
            return $query->add(
                $this->config->getFilterFieldTypeMapping()[$filterFieldType],
                $filterFieldTransfer->getValue(),
                Criteria::EQUAL,
            );
        }

        if ($filterFieldType === CompanyUserSearchRestApiConstants::FILTER_FIELD_TYPE_ORDER_BY) {
            return $this->addOrderByFilter(
                $query,
                $filterFieldTransfer,
            );
        }

        return $query;
    }

    /**
     * @param \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery $query
     * @param \Generated\Shared\Transfer\FilterFieldTransfer $filterFieldTransfer
     *
     * @return \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery
     */
    protected function addAllSearchTypeFilter(
        SpyCompanyUserQuery $query,
        FilterFieldTransfer $filterFieldTransfer
    ): SpyCompanyUserQuery {
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
     * @param \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery $query
     * @param \Generated\Shared\Transfer\FilterFieldTransfer $filterFieldTransfer
     *
     * @return \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery
     */
    protected function addOrderByFilter(
        SpyCompanyUserQuery $query,
        FilterFieldTransfer $filterFieldTransfer
    ): SpyCompanyUserQuery {
        [$orderColumn, $orderDirection] = explode(
            CompanyUserSearchRestApiConstants::DELIMITER_ORDER_BY,
            $filterFieldTransfer->getValue(),
        );

        if (!$orderColumn) {
            return $query;
        }

        if (isset($this->config->getSortFieldMapping()[$orderColumn])) {
            $orderColumn = $this->config->getSortFieldMapping()[$orderColumn];
        }

        $query->orderBy($orderColumn, $orderDirection);

        return $query;
    }
}
