<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Persistence;

use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class CompanyDeleterCompanyUserConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery
     */
    public function createSpyCompanyUserQuery(): SpyCompanyUserQuery
    {
        return SpyCompanyUserQuery::create();
    }
}
