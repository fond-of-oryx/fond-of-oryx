<?php

namespace FondOfOryx\Zed\OrderBudget\Persistence;

use FondOfOryx\Zed\OrderBudget\Persistence\Propel\Mapper\OrderBudgetHistoryMapper;
use FondOfOryx\Zed\OrderBudget\Persistence\Propel\Mapper\OrderBudgetHistoryMapperInterface;
use FondOfOryx\Zed\OrderBudget\Persistence\Propel\Mapper\OrderBudgetMapper;
use FondOfOryx\Zed\OrderBudget\Persistence\Propel\Mapper\OrderBudgetMapperInterface;
use Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\OrderBudget\OrderBudgetConfig getConfig()
 */
class OrderBudgetPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \FondOfOryx\Zed\OrderBudget\Persistence\Propel\Mapper\OrderBudgetHistoryMapperInterface
     */
    public function createOrderBudgetHistoryMapper(): OrderBudgetHistoryMapperInterface
    {
        return new OrderBudgetHistoryMapper();
    }

    /**
     * @return \FondOfOryx\Zed\OrderBudget\Persistence\Propel\Mapper\OrderBudgetMapperInterface
     */
    public function createOrderBudgetMapper(): OrderBudgetMapperInterface
    {
        return new OrderBudgetMapper();
    }

    /**
     * @return \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery
     */
    public function createFooOrderBudgetQuery(): FooOrderBudgetQuery
    {
        return FooOrderBudgetQuery::create();
    }
}
