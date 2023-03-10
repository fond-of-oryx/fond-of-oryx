<?php

namespace FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Persistence;

use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;

class CompanyDeleterErpOrderConnectorPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery
     */
    public function createSpyCompanyBusinessUnitQuery(): SpyCompanyBusinessUnitQuery
    {
        return SpyCompanyBusinessUnitQuery::create();
    }
}