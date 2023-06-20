<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence;

use FondOfOryx\Zed\CompanyUsersBulkRestApi\CompanyUsersBulkRestApiDependencyProvider;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Orm\Zed\Permission\Persistence\Base\SpyPermissionQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class CompanyUsersBulkRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function getCustomerQuery(): SpyCustomerQuery
    {
        return $this->getProvidedDependency(CompanyUsersBulkRestApiDependencyProvider::QUERY_SPY_CUSTOMER);
    }

    /**
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery
     */
    public function getCompanyUserQuery(): SpyCompanyUserQuery
    {
        return $this->getProvidedDependency(
            CompanyUsersBulkRestApiDependencyProvider::QUERY_SPY_COMPANY_USER,
        );
    }

    /**
     * @return \Orm\Zed\Permission\Persistence\Base\SpyPermissionQuery
     */
    public function getPermissionQuery(): SpyPermissionQuery
    {
        return $this->getProvidedDependency(
            CompanyUsersBulkRestApiDependencyProvider::PROPEL_QUERY_PERMISSION,
        );
    }
}
