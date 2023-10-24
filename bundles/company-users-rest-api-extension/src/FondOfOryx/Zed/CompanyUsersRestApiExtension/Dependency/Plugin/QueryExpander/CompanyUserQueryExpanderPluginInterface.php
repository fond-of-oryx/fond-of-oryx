<?php

namespace FondOfOryx\Zed\CompanyUsersRestApiExtension\Dependency\Plugin\QueryExpander;

use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;

interface CompanyUserQueryExpanderPluginInterface
{
    /**
     * @param \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery $companyUserQuery
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery
     */
    public function expandCompanyUserQuery(SpyCompanyUserQuery $companyUserQuery): SpyCompanyUserQuery;
}
