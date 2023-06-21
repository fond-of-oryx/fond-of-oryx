<?php

namespace FondOfOryx\Zed\CustomerProductListSearchRestApi\Persistence;

use FondOfOryx\Zed\CustomerProductListSearchRestApi\CustomerProductListSearchRestApiDependencyProvider;
use Orm\Zed\ProductList\Persistence\Base\SpyProductListQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 */
class CustomerProductListSearchRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductList\Persistence\Base\SpyProductListQuery
     */
    public function getProductListQuery(): SpyProductListQuery
    {
        return $this->getProvidedDependency(CustomerProductListSearchRestApiDependencyProvider::PROPEL_QUERY_PRODUCT_LIST);
    }
}
