<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence;

use FondOfOryx\Zed\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiDependencyProvider;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\Propel\Mapper\OrderBudgetMapper;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\Propel\Mapper\OrderBudgetMapperInterface;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\Propel\QueryBuilder\OrderBudgetQueryJoinQueryBuilder;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\Propel\QueryBuilder\OrderBudgetQueryJoinQueryBuilderInterface;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\Propel\QueryBuilder\OrderBudgetSearchFilterFieldQueryBuilder;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\Propel\QueryBuilder\OrderBudgetSearchFilterFieldQueryBuilderInterface;
use Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig getConfig()
 */
class OrderBudgetSearchRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery
     */
    public function getOrderBudgetQuery(): FooOrderBudgetQuery
    {
        return $this->getProvidedDependency(OrderBudgetSearchRestApiDependencyProvider::PROPEL_QUERY_ORDER_BUDGET);
    }

    /**
     * @return \FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\Propel\Mapper\OrderBudgetMapperInterface
     */
    public function createOrderBudgetMapper(): OrderBudgetMapperInterface
    {
        return new OrderBudgetMapper();
    }

    /**
     * @return \FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\Propel\QueryBuilder\OrderBudgetQueryJoinQueryBuilderInterface
     */
    public function createOrderBudgetQueryJoinQueryBuilder(): OrderBudgetQueryJoinQueryBuilderInterface
    {
        return new OrderBudgetQueryJoinQueryBuilder();
    }

    /**
     * @return \FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\Propel\QueryBuilder\OrderBudgetSearchFilterFieldQueryBuilderInterface
     */
    public function createOrderBudgetSearchFilterFieldQueryBuilder(): OrderBudgetSearchFilterFieldQueryBuilderInterface
    {
        return new OrderBudgetSearchFilterFieldQueryBuilder(
            $this->getConfig(),
        );
    }
}
