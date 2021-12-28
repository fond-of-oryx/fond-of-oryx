<?php

namespace FondOfOryx\Zed\CompanyRoleApi\Persistence;

use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery;

interface CompanyRoleApiQueryContainerInterface
{
    /**
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery
     */
    public function queryFind(): SpyCompanyRoleQuery;
}
