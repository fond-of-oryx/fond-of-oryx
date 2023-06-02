<?php

namespace FondOfOryx\Zed\CompanySearchRestApi\Persistence\Propel\QueryBuilder;

use FondOfOryx\Shared\CompanySearchRestApi\CompanySearchRestApiConstants;
use FondOfOryx\Zed\CompanySearchRestApi\CompanySearchRestApiConfig;
use Generated\Shared\Transfer\CompanyListTransfer;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Orm\Zed\Company\Persistence\Base\SpyCompanyQuery;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * @codeCoverageIgnore
 */
class CompanySearchFilterFieldQueryBuilder implements CompanySearchFilterFieldQueryBuilderInterface
{
    /**
     * @var string
     */
    public const CONDITION_GROUP_ALL = 'CONDITION_GROUP_ALL';

    /**
     * @var \FondOfOryx\Zed\CompanySearchRestApi\CompanySearchRestApiConfig
     */
    protected CompanySearchRestApiConfig $config;

    /**
     * @param \FondOfOryx\Zed\CompanySearchRestApi\CompanySearchRestApiConfig $config
     */
    public function __construct(CompanySearchRestApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery $query
     * @param \Generated\Shared\Transfer\CompanyListTransfer $orderBudgetListTransfer
     *
     * @return \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery
     */
    public function addQueryFilters(
        SpyCompanyQuery $query,
        CompanyListTransfer $orderBudgetListTransfer
    ): SpyCompanyQuery {
        foreach ($orderBudgetListTransfer->getFilterFields() as $filterFieldTransfer) {
            $query = $this->addQueryFilter($query, $filterFieldTransfer);
        }

        return $query;
    }

    /**
     * @param \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery $query
     * @param \Generated\Shared\Transfer\FilterFieldTransfer $filterFieldTransfer
     *
     * @return \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery
     */
    protected function addQueryFilter(
        SpyCompanyQuery $query,
        FilterFieldTransfer $filterFieldTransfer
    ): SpyCompanyQuery {
        $filterFieldType = $filterFieldTransfer->getType();

        if ($filterFieldType === CompanySearchRestApiConstants::FILTER_FIELD_TYPE_ALL) {
            return $this->addAllSearchTypeFilter($query, $filterFieldTransfer);
        }

        if (isset($this->config->getFilterFieldTypeMapping()[$filterFieldType])) {
            return $query->add(
                $this->config->getFilterFieldTypeMapping()[$filterFieldType],
                $filterFieldTransfer->getValue(),
                Criteria::EQUAL,
            );
        }

        if ($filterFieldType === CompanySearchRestApiConstants::FILTER_FIELD_TYPE_ORDER_BY) {
            return $this->addOrderByFilter(
                $query,
                $filterFieldTransfer,
            );
        }

        return $query;
    }

    /**
     * @param \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery $query
     * @param \Generated\Shared\Transfer\FilterFieldTransfer $filterFieldTransfer
     *
     * @return \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery
     */
    protected function addAllSearchTypeFilter(
        SpyCompanyQuery $query,
        FilterFieldTransfer $filterFieldTransfer
    ): SpyCompanyQuery {
        $conditions = [];

        foreach ($this->config->getFullTextColumns() as $column) {
            $conditionName = uniqid($column, true);

            $query->addCond(
                $conditionName,
                $column,
                $this->generateLikePattern($filterFieldTransfer->getValue()),
                Criteria::ILIKE,
            );

            $conditions[] = $conditionName;
        }

        if (count($conditions) === 0) {
            return $query;
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
     * @param \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery $query
     * @param \Generated\Shared\Transfer\FilterFieldTransfer $filterFieldTransfer
     *
     * @return \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery
     */
    protected function addOrderByFilter(
        SpyCompanyQuery $query,
        FilterFieldTransfer $filterFieldTransfer
    ): SpyCompanyQuery {
        [$orderColumn, $orderDirection] = explode(
            CompanySearchRestApiConstants::DELIMITER_ORDER_BY,
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
