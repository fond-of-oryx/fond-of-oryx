<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Persistence;

use FondOfOryx\Zed\CompanyUserMailConnector\CompanyUserMailConnectorDependencyProvider;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class CompanyUserMailConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getSpyCustomerQuery(): SpyCustomerQuery
    {
        return $this->getProvidedDependency(CompanyUserMailConnectorDependencyProvider::QUERY_CUSTOMER);
    }
}
