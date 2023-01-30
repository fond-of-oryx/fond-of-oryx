<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitApi\Persistence;

use FondOfOryx\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiDependencyProvider;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToApiFacadeInterface;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryBuilderQueryContainerInterface;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiConfig getConfig()
 * @method \FondOfOryx\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiRepositoryInterface getRepository()
 */
class CompanyBusinessUnitApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery
     */
    public function getCompanyBusinessUnitQuery(): SpyCompanyBusinessUnitQuery
    {
        return $this->getProvidedDependency(
            CompanyBusinessUnitApiDependencyProvider::PROPEL_QUERY_COMPANY_BUSINESS_UNIT,
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryBuilderQueryContainerInterface
     */
    public function getApiQueryBuilderQueryContainer(): CompanyBusinessUnitApiToApiQueryBuilderQueryContainerInterface
    {
        return $this->getProvidedDependency(CompanyBusinessUnitApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToApiFacadeInterface
     */
    public function getApiFacade(): CompanyBusinessUnitApiToApiFacadeInterface
    {
        return $this->getProvidedDependency(CompanyBusinessUnitApiDependencyProvider::FACADE_API);
    }
}
