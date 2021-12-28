<?php

namespace FondOfOryx\Zed\CompanyRoleApi\Persistence;

use FondOfOryx\Zed\CompanyRoleApi\CompanyRoleApiDependencyProvider;
use FondOfOryx\Zed\CompanyRoleApi\Dependency\QueryContainer\CompanyRoleApiToApiQueryBuilderQueryContainerInterface;
use FondOfOryx\Zed\CompanyRoleApi\Dependency\QueryContainer\CompanyRoleApiToApiQueryContainerInterface;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CompanyRoleApi\CompanyRoleApiConfig getConfig()
 * @method \FondOfOryx\Zed\CompanyRoleApi\Persistence\CompanyRoleApiQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\CompanyRoleApi\Persistence\CompanyRoleApiRepositoryInterface getRepository()
 */
class CompanyRoleApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery
     */
    public function getCompanyRoleQuery(): SpyCompanyRoleQuery
    {
        return $this->getProvidedDependency(CompanyRoleApiDependencyProvider::PROPEL_QUERY_COMPANY_ROLE);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyRoleApi\Dependency\QueryContainer\CompanyRoleApiToApiQueryBuilderQueryContainerInterface
     */
    public function getApiQueryBuilderQueryContainer(): CompanyRoleApiToApiQueryBuilderQueryContainerInterface
    {
        return $this->getProvidedDependency(CompanyRoleApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyRoleApi\Dependency\QueryContainer\CompanyRoleApiToApiQueryContainerInterface
     */
    public function getApiQueryContainer(): CompanyRoleApiToApiQueryContainerInterface
    {
        return $this->getProvidedDependency(CompanyRoleApiDependencyProvider::QUERY_CONTAINER_API);
    }
}
