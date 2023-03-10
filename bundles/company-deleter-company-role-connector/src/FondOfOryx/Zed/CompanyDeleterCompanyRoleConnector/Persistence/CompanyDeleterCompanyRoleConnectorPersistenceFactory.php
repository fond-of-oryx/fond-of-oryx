<?php

namespace FondOfOryx\Zed\CompanyDeleterProductListConnector\Persistence;

use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class CompanyDeleterCompanyRoleConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery
     */
    public function createSpyCompanyRoleQuery(): SpyCompanyRoleQuery
    {
        return SpyCompanyRoleQuery::create();
    }
}
