<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Persistence;

use FondOfOryx\Zed\ProductListsRestApi\ProductListsRestApiDependencyProvider;
use Orm\Zed\ProductList\Persistence\Base\SpyProductListQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 */
class ProductListsRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductList\Persistence\Base\SpyProductListQuery
     */
    public function getProductListQuery(): SpyProductListQuery
    {
        return $this->getProvidedDependency(ProductListsRestApiDependencyProvider::PROPEL_QUERY_PRODUCT_LIST);
    }
}
