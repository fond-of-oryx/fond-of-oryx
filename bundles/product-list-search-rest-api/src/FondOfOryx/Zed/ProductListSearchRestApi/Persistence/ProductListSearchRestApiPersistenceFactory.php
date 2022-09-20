<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Persistence;

use FondOfOryx\Zed\ProductListSearchRestApi\Persistence\Propel\Mapper\ProductListMapper;
use FondOfOryx\Zed\ProductListSearchRestApi\Persistence\Propel\Mapper\ProductListMapperInterface;
use FondOfOryx\Zed\ProductListSearchRestApi\ProductListSearchRestApiDependencyProvider;
use Orm\Zed\ProductList\Persistence\SpyProductListQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\ProductListSearchRestApi\Persistence\ProductListSearchRestApiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ProductListSearchRestApi\ProductListSearchRestApiConfig getConfig()
 */
class ProductListSearchRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery
     */
    public function getProductListQuery(): SpyProductListQuery
    {
        return $this->getProvidedDependency(ProductListSearchRestApiDependencyProvider::PROPEL_QUERY_PRODUCT_LIST);
    }

    /**
     * @return \FondOfOryx\Zed\ProductListSearchRestApi\Persistence\Propel\Mapper\ProductListMapperInterface
     */
    public function createProductListMapper(): ProductListMapperInterface
    {
        return new ProductListMapper();
    }
}
