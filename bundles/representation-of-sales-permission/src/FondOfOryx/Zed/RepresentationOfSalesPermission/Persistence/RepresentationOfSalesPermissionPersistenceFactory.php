<?php

namespace FondOfOryx\Zed\RepresentationOfSalesPermission\Persistence;

use FondOfOryx\Zed\RepresentationOfSalesPermission\RepresentationOfSalesPermissionDependencyProvider;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class RepresentationOfSalesPermissionPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery
     */
    public function getSpyCompanyRoleToPermissionQuery(): SpyCompanyRoleToPermissionQuery
    {
        return $this->getProvidedDependency(RepresentationOfSalesPermissionDependencyProvider::QUERY_SPY_COMPANY_ROLE_PERMISSION);
    }
}
