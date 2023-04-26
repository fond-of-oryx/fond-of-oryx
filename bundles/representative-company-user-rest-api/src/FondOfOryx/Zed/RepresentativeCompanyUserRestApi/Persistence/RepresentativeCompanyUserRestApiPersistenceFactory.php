<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Persistence;

use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiDependencyProvider;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class RepresentativeCompanyUserRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function getCustomerQuery(): SpyCustomerQuery
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserRestApiDependencyProvider::QUERY_SPY_CUSTOMER);
    }

    /**
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery
     */
    public function getSpyCompanyUserQuery(): SpyCompanyUserQuery
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserRestApiDependencyProvider::QUERY_SPY_COMPANY_USER);
    }
}
