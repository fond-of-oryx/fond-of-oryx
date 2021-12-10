<?php

namespace FondOfOryx\Zed\CustomerProductListConnector\Persistence;

use FondOfOryx\Zed\CustomerProductListConnector\CustomerProductListConnectorDependencyProvider;
use Orm\Zed\ProductList\Persistence\Base\SpyProductListCustomerQuery;
use Orm\Zed\ProductList\Persistence\Base\SpyProductListQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorRepositoryInterface getRepository()
 */
class CustomerProductListConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductList\Persistence\Base\SpyProductListQuery
     */
    public function getProductListQuery(): SpyProductListQuery
    {
        return $this->getProvidedDependency(
            CustomerProductListConnectorDependencyProvider::PROPEL_QUERY_PRODUCT_LIST,
        );
    }

    /**
     * @return \Orm\Zed\ProductList\Persistence\Base\SpyProductListCustomerQuery
     */
    public function getProductListCustomerQuery(): SpyProductListCustomerQuery
    {
        return $this->getProvidedDependency(
            CustomerProductListConnectorDependencyProvider::PROPEL_QUERY_PRODUCT_LIST_CUSTOMER,
        );
    }
}
