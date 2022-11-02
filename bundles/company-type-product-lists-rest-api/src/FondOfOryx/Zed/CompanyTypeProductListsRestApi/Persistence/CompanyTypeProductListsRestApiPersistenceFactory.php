<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Persistence;

use FondOfOryx\Zed\CompanyTypeProductListsRestApi\CompanyTypeProductListsRestApiDependencyProvider;
use Orm\Zed\Company\Persistence\Base\SpyCompanyQuery;
use Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery;
use Orm\Zed\Customer\Persistence\Base\SpyCustomerQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 */
class CompanyTypeProductListsRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery
     */
    public function getCompanyUserQuery(): SpyCompanyUserQuery
    {
        return $this->getProvidedDependency(
            CompanyTypeProductListsRestApiDependencyProvider::PROPEL_QUERY_COMPANY_USER,
        );
    }

    /**
     * @return \Orm\Zed\Customer\Persistence\Base\SpyCustomerQuery
     */
    public function getCustomerQuery(): SpyCustomerQuery
    {
        return $this->getProvidedDependency(
            CompanyTypeProductListsRestApiDependencyProvider::PROPEL_QUERY_CUSTOMER,
        );
    }

    /**
     * @return \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery
     */
    public function getCompanyQuery(): SpyCompanyQuery
    {
        return $this->getProvidedDependency(
            CompanyTypeProductListsRestApiDependencyProvider::PROPEL_QUERY_COMPANY,
        );
    }
}
