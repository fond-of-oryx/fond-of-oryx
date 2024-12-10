<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Persistence;

use FondOfOryx\Zed\CompanyProductListsRestApi\CompanyProductListsRestApiDependencyProvider;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Orm\Zed\ProductList\Persistence\Base\SpyProductListCompanyQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 */
class CompanyProductListsRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductList\Persistence\Base\SpyProductListCompanyQuery
     */
    public function getProductListCompanyQuery(): SpyProductListCompanyQuery
    {
        return $this->getProvidedDependency(
            CompanyProductListsRestApiDependencyProvider::PROPEL_QUERY_PRODUCT_LIST_COMPANY,
        );
    }

    /**
     * @return \Orm\Zed\Company\Persistence\SpyCompanyQuery
     */
    public function getCompanyQuery(): SpyCompanyQuery
    {
        return $this->getProvidedDependency(
            CompanyProductListsRestApiDependencyProvider::PROPEL_QUERY_COMPANY,
        );
    }
}
