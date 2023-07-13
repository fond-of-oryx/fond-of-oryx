<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Persistence;

use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiDependencyProvider;
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
}
