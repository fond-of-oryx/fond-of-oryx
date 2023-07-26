<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Persistence;

use FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\CompanyUsersBulkRestApiBusinessCentralConnectorDependencyProvider;
use Orm\Zed\Company\Persistence\Base\SpyCompanyQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class CompanyUsersBulkRestApiBusinessCentralConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery
     */
    public function getCompanyQuery(): SpyCompanyQuery
    {
        return $this->getProvidedDependency(
            CompanyUsersBulkRestApiBusinessCentralConnectorDependencyProvider::QUERY_SPY_COMPANY,
        );
    }
}
