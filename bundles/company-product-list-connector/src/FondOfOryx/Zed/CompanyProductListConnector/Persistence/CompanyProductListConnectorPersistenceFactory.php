<?php

namespace FondOfOryx\Zed\CompanyProductListConnector\Persistence;

use FondOfOryx\Zed\CompanyProductListConnector\CompanyProductListConnectorDependencyProvider;
use Orm\Zed\ProductList\Persistence\Base\SpyProductListCompanyQuery;
use Orm\Zed\ProductList\Persistence\Base\SpyProductListQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorRepositoryInterface getRepository()
 */
class CompanyProductListConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductList\Persistence\Base\SpyProductListQuery
     */
    public function getProductListQuery(): SpyProductListQuery
    {
        return $this->getProvidedDependency(
            CompanyProductListConnectorDependencyProvider::PROPEL_QUERY_PRODUCT_LIST,
        );
    }

    /**
     * @return \Orm\Zed\ProductList\Persistence\Base\SpyProductListCompanyQuery
     */
    public function getProductListCompanyQuery(): SpyProductListCompanyQuery
    {
        return $this->getProvidedDependency(
            CompanyProductListConnectorDependencyProvider::PROPEL_QUERY_PRODUCT_LIST_COMPANY,
        );
    }
}
