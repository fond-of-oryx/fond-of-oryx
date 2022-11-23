<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Persistence;

use FondOfOryx\Zed\CustomerProductListsRestApi\CustomerProductListsRestApiDependencyProvider;
use Orm\Zed\Customer\Persistence\Base\SpyCustomerQuery;
use Orm\Zed\ProductList\Persistence\Base\SpyProductListCustomerQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 */
class CustomerProductListsRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductList\Persistence\Base\SpyProductListCustomerQuery
     */
    public function getProductListCustomerQuery(): SpyProductListCustomerQuery
    {
        return $this->getProvidedDependency(
            CustomerProductListsRestApiDependencyProvider::PROPEL_QUERY_PRODUCT_LIST_CUSTOMER,
        );
    }

    /**
     * @return \Orm\Zed\Customer\Persistence\Base\SpyCustomerQuery
     */
    public function getCustomerQuery(): SpyCustomerQuery
    {
        return $this->getProvidedDependency(
            CustomerProductListsRestApiDependencyProvider::PROPEL_QUERY_CUSTOMER,
        );
    }
}
