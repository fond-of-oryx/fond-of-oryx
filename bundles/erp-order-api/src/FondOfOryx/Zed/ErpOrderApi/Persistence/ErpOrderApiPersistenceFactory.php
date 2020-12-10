<?php

namespace FondOfOryx\Zed\ErpOrderApi\Persistence;

use FondOfOryx\Zed\ErpOrderApi\Dependency\QueryContainer\ErpOrderApiToApiQueryBuilderQueryContainerInterface;
use FondOfOryx\Zed\ErpOrderApi\Dependency\QueryContainer\ErpOrderApiToApiQueryContainerInterface;
use FondOfOryx\Zed\ErpOrderApi\ErpOrderApiDependencyProvider;
use Orm\Zed\ErpOrder\Persistence\FooErpOrderQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\ErpOrderApi\Persistence\ErpOrderApiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ErpOrderApi\ErpOrderApiConfig getConfig()
 */
class ErpOrderApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ErpOrder\Persistence\FooErpOrderQuery
     */
    public function getErpOrderQuery(): FooErpOrderQuery
    {
        return $this->getProvidedDependency(ErpOrderApiDependencyProvider::PROPEL_QUERY_ERP_ORDER);
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrderApi\Dependency\QueryContainer\ErpOrderApiToApiQueryBuilderQueryContainerInterface
     */
    public function getApiQueryBuilderQueryContainer(): ErpOrderApiToApiQueryBuilderQueryContainerInterface
    {
        return $this->getProvidedDependency(ErpOrderApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER);
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrderApi\Dependency\QueryContainer\ErpOrderApiToApiQueryContainerInterface
     */
    public function getApiQueryContainer(): ErpOrderApiToApiQueryContainerInterface
    {
        return $this->getProvidedDependency(ErpOrderApiDependencyProvider::QUERY_CONTAINER_API);
    }
}
