<?php

namespace FondOfOryx\Zed\ProductListApi\Persistence;

use FondOfOryx\Zed\ProductListApi\Dependency\Facade\ProductListApiToApiFacadeInterface;
use FondOfOryx\Zed\ProductListApi\Dependency\QueryContainer\ProductListApiToApiQueryBuilderQueryContainerInterface;
use FondOfOryx\Zed\ProductListApi\ProductListApiDependencyProvider;
use Orm\Zed\ProductList\Persistence\SpyProductListQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\ProductListApi\ProductListApiConfig getConfig()
 * @method \FondOfOryx\Zed\ProductListApi\Persistence\ProductListApiRepositoryInterface getRepository()
 */
class ProductListApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery
     */
    public function getProductListQuery(): SpyProductListQuery
    {
        return $this->getProvidedDependency(ProductListApiDependencyProvider::PROPEL_QUERY_PRODUCT_LIST);
    }

    /**
     * @return \FondOfOryx\Zed\ProductListApi\Dependency\QueryContainer\ProductListApiToApiQueryBuilderQueryContainerInterface
     */
    public function getApiQueryBuilderQueryContainer(): ProductListApiToApiQueryBuilderQueryContainerInterface
    {
        return $this->getProvidedDependency(ProductListApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER);
    }

    /**
     * @return \FondOfOryx\Zed\ProductListApi\Dependency\Facade\ProductListApiToApiFacadeInterface
     */
    public function getApiFacade(): ProductListApiToApiFacadeInterface
    {
        return $this->getProvidedDependency(ProductListApiDependencyProvider::FACADE_API);
    }
}
