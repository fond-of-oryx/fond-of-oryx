<?php

namespace FondOfOryx\Zed\CompanyProductListSearchRestApi\Persistence;

use FondOfOryx\Zed\CompanyProductListSearchRestApi\CompanyProductListSearchRestApiDependencyProvider;
use Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 */
class CompanyProductListSearchRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery
     */
    public function getCompanyUserQuery(): SpyCompanyUserQuery
    {
        return $this->getProvidedDependency(CompanyProductListSearchRestApiDependencyProvider::PROPEL_QUERY_COMPANY_USER);
    }
}
