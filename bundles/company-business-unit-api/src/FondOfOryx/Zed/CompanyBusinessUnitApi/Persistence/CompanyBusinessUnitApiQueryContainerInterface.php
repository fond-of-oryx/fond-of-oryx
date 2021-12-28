<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitApi\Persistence;

use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;

interface CompanyBusinessUnitApiQueryContainerInterface
{
    /**
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery
     */
    public function queryFind(): SpyCompanyBusinessUnitQuery;
}
