<?php

namespace FondOfOryx\Zed\ReturnLabel\Dependency\QueryContainer;

use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;

interface ReturnLabelToCompanyUnitAddressQueryContainerInterface
{
    /**
     * @return SpyCompanyUnitAddressQuery
     */
    public function queryCompanyUnitAddress(): SpyCompanyUnitAddressQuery
}
