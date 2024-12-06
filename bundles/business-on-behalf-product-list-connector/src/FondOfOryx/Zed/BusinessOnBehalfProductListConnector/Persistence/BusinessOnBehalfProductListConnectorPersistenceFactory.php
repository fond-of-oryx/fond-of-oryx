<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Persistence;

use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\BusinessOnBehalfProductListConnectorDependencyProvider;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 */
class BusinessOnBehalfProductListConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery
     */
    public function getCompanyUserQuery(): SpyCompanyUserQuery
    {
        return $this->getProvidedDependency(
            BusinessOnBehalfProductListConnectorDependencyProvider::PROPEL_QUERY_COMPANY_USER,
        );
    }

    /**
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function getCustomerQuery(): SpyCustomerQuery
    {
        return $this->getProvidedDependency(
            BusinessOnBehalfProductListConnectorDependencyProvider::PROPEL_QUERY_CUSTOMER,
        );
    }
}
