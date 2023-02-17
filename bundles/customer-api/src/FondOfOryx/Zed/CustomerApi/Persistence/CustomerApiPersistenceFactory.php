<?php

namespace FondOfOryx\Zed\CustomerApi\Persistence;

use FondOfOryx\Zed\CustomerApi\CustomerApiDependencyProvider;
use FondOfOryx\Zed\CustomerApi\Dependency\Facade\CustomerApiToApiFacadeInterface;
use FondOfOryx\Zed\CustomerApi\Dependency\QueryContainer\CustomerApiToApiQueryBuilderQueryContainerInterface;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 */
class CustomerApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function getCustomerQuery(): SpyCustomerQuery
    {
        return $this->getProvidedDependency(CustomerApiDependencyProvider::PROPEL_QUERY_CUSTOMER);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerApi\Dependency\QueryContainer\CustomerApiToApiQueryBuilderQueryContainerInterface
     */
    public function getApiQueryBuilderQueryContainer(): CustomerApiToApiQueryBuilderQueryContainerInterface
    {
        return $this->getProvidedDependency(CustomerApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerApi\Dependency\Facade\CustomerApiToApiFacadeInterface
     */
    public function getApiFacade(): CustomerApiToApiFacadeInterface
    {
        return $this->getProvidedDependency(CustomerApiDependencyProvider::FACADE_API);
    }
}
