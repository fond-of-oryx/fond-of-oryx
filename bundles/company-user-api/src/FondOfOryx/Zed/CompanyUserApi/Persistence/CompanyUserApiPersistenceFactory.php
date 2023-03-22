<?php

namespace FondOfOryx\Zed\CompanyUserApi\Persistence;

use FondOfOryx\Zed\CompanyUserApi\CompanyUserApiDependencyProvider;
use FondOfOryx\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToApiFacadeInterface;
use FondOfOryx\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryBuilderQueryContainerInterface;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CompanyUserApi\CompanyUserApiConfig getConfig()
 */
class CompanyUserApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery
     */
    public function getCompanyUserQuery(): SpyCompanyUserQuery
    {
        return $this->getProvidedDependency(CompanyUserApiDependencyProvider::PROPEL_QUERY_COMPANY_USER);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToApiFacadeInterface
     */
    public function getApiFacade(): CompanyUserApiToApiFacadeInterface
    {
        return $this->getProvidedDependency(CompanyUserApiDependencyProvider::FACADE_API);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryBuilderQueryContainerInterface
     */
    public function getApiQueryBuilderQueryContainer(): CompanyUserApiToApiQueryBuilderQueryContainerInterface
    {
        return $this->getProvidedDependency(
            CompanyUserApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER,
        );
    }
}
