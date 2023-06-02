<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApiPermission\Persistence;

use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApiPermission\RepresentativeCompanyUserTradeFairRestApiPermissionDependencyProvider;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class RepresentativeCompanyUserTradeFairRestApiPermissionPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery
     */
    public function getSpyCompanyRoleToPermissionQuery(): SpyCompanyRoleToPermissionQuery
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserTradeFairRestApiPermissionDependencyProvider::QUERY_SPY_COMPANY_ROLE_PERMISSION);
    }
}
