<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Persistence;

use FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\CompanyUsersBulkRestApiBusinessCentralConnectorDependencyProvider;
use FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Dependency\Facade\CompanyUsersBulkRestApiBusinessCentralConnectorToCompanyUsersBulkRestApiFacadeInterface;
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

    /**
     * @return \FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Dependency\Facade\CompanyUsersBulkRestApiBusinessCentralConnectorToCompanyUsersBulkRestApiFacadeInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getCompanyUsersBulkRestApiFacade(): CompanyUsersBulkRestApiBusinessCentralConnectorToCompanyUsersBulkRestApiFacadeInterface
    {
        return $this->getProvidedDependency(
            CompanyUsersBulkRestApiBusinessCentralConnectorDependencyProvider::FACADE_COMPANY_USERS_BULK_REST_API,
        );
    }
}
