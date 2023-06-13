<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Persistence;

use FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\CompanyTypeProductListSearchRestApiDependencyProvider;
use Orm\Zed\Customer\Persistence\Base\SpyCustomerQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\CompanyTypeProductListSearchRestApiConfig getConfig()
 */
class CompanyTypeProductListSearchRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Customer\Persistence\Base\SpyCustomerQuery
     */
    public function getCustomerQuery(): SpyCustomerQuery
    {
        return $this->getProvidedDependency(
            CompanyTypeProductListSearchRestApiDependencyProvider::PROPEL_QUERY_CUSTOMER,
        );
    }
}
