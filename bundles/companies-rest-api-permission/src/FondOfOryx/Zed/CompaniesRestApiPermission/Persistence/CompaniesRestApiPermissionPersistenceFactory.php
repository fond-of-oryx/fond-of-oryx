<?php

namespace FondOfOryx\Zed\CompaniesRestApiPermission\Persistence;

use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class CompaniesRestApiPermissionPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery
     */
    public function createSpyCompanyRoleToPermissionQuery(): SpyCompanyRoleToPermissionQuery
    {
        return SpyCompanyRoleToPermissionQuery::create();
    }
}
