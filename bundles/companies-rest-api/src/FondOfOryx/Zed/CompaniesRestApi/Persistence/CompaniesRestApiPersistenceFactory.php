<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Persistence;

use FondOfOryx\Zed\CompaniesRestApi\CompaniesRestApiDependencyProvider;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class CompaniesRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Company\Persistence\SpyCompanyQuery
     */
    public function getCompanyQuery(): SpyCompanyQuery
    {
        return $this->getProvidedDependency(CompaniesRestApiDependencyProvider::QUERY_SPY_COMPANY);
    }
}
