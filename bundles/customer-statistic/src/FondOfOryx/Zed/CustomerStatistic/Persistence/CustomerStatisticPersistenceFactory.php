<?php

namespace FondOfOryx\Zed\CustomerStatistic\Persistence;

use FondOfOryx\Zed\CustomerStatistic\CustomerStatisticDependencyProvider;
use FondOfOryx\Zed\CustomerStatistic\Dependency\QueryContainer\CustomerStatisticToCustomerQueryContainerInterface;
use FondOfOryx\Zed\CustomerStatistic\Persistence\Propel\Mapper\CustomerStatisticMapper;
use FondOfOryx\Zed\CustomerStatistic\Persistence\Propel\Mapper\CustomerStatisticMapperInterface;
use Orm\Zed\CustomerStatistic\Persistence\FooCustomerStatisticQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticRepositoryInterface getRepository()
 */
class CustomerStatisticPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \FondOfOryx\Zed\CustomerStatistic\Dependency\QueryContainer\CustomerStatisticToCustomerQueryContainerInterface
     */
    public function getCustomerQueryContainer(): CustomerStatisticToCustomerQueryContainerInterface
    {
        return $this->getProvidedDependency(CustomerStatisticDependencyProvider::QUERY_CONTAINER_CUSTOMER);
    }

    /**
     * @return \Orm\Zed\CustomerStatistic\Persistence\FooCustomerStatisticQuery
     */
    public function createFooCustomerStatisticQuery(): FooCustomerStatisticQuery
    {
        return FooCustomerStatisticQuery::create();
    }

    /**
     * @return \FondOfOryx\Zed\CustomerStatistic\Persistence\Propel\Mapper\CustomerStatisticMapperInterface
     */
    public function createCustomerStatisticMapper(): CustomerStatisticMapperInterface
    {
        return new CustomerStatisticMapper();
    }
}
