<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Persistence;

use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class CompanyDeleterCompanyBusinessUnitConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery
     */
    public function createSpyCompanyBusinessUnitQuery(): SpyCompanyBusinessUnitQuery
    {
        return SpyCompanyBusinessUnitQuery::create();
    }
}
