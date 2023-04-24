<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApiPermission\Persistence;

use FondOfOryx\Zed\RepresentativeCompanyUserRestApiPermission\RepresentativeCompanyUserRestApiPermissionDependencyProvider;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class RepresentativeCompanyUserRestApiPermissionPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery
     */
    public function getSpyCompanyRoleToPermissionQuery(): SpyCompanyRoleToPermissionQuery
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserRestApiPermissionDependencyProvider::QUERY_SPY_COMPANY_ROLE_PERMISSION);
    }
}
