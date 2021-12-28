<?php

namespace FondOfOryx\Zed\CompanyRoleApi\Persistence;

use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CompanyRoleApi\Persistence\CompanyRoleApiPersistenceFactory getFactory()
 */
class CompanyRoleApiQueryContainer extends AbstractQueryContainer implements CompanyRoleApiQueryContainerInterface
{
    /**
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery
     */
    public function queryFind(): SpyCompanyRoleQuery
    {
        return $this->getFactory()->getCompanyRoleQuery();
    }
}
