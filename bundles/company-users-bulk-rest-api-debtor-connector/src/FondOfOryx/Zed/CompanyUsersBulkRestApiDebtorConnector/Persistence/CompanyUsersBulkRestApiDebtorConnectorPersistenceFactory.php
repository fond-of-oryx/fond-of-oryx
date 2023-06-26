<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApiDebtorConnector\Persistence;

use FondOfOryx\Zed\CompanyUsersBulkRestApiDebtorConnector\CompanyUsersBulkRestApiDebtorConnectorDependencyProvider;
use Orm\Zed\Company\Persistence\Base\SpyCompanyQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class CompanyUsersBulkRestApiDebtorConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery
     */
    public function getCompanyQuery(): SpyCompanyQuery
    {
        return $this->getProvidedDependency(
            CompanyUsersBulkRestApiDebtorConnectorDependencyProvider::QUERY_SPY_COMPANY,
        );
    }
}
