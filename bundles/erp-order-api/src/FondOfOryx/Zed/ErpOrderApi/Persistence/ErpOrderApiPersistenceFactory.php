<?php

namespace FondOfOryx\Zed\ErpOrderApi\Persistence;

use FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToApiFacadeInterface;
use FondOfOryx\Zed\ErpOrderApi\Dependency\QueryContainer\ErpOrderApiToApiQueryBuilderQueryContainerInterface;
use FondOfOryx\Zed\ErpOrderApi\ErpOrderApiDependencyProvider;
use Orm\Zed\ErpOrder\Persistence\ErpOrderQuery;
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
     * @return \Orm\Zed\ErpOrder\Persistence\ErpOrderQuery
     */
    public function getErpOrderQuery(): ErpOrderQuery
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
     * @return \FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToApiFacadeInterface
     */
    public function getApiFacade(): ErpOrderApiToApiFacadeInterface
    {
        return $this->getProvidedDependency(ErpOrderApiDependencyProvider::FACADE_API);
    }
}
