<?php

namespace FondOfOryx\Zed\CompanyUnitAddressApi\Persistence;

use FondOfOryx\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiDependencyProvider;
use FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToApiFacadeInterface;
use FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryBuilderQueryContainerInterface;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiConfig getConfig()
 */
class CompanyUnitAddressApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery
     */
    public function getCompanyUnitAddressQuery(): SpyCompanyUnitAddressQuery
    {
        return $this->getProvidedDependency(
            CompanyUnitAddressApiDependencyProvider::PROPEL_QUERY_COMPANY_UNIT_ADDRESS,
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToApiFacadeInterface
     */
    public function getApiFacade(): CompanyUnitAddressApiToApiFacadeInterface
    {
        return $this->getProvidedDependency(
            CompanyUnitAddressApiDependencyProvider::FACADE_API,
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryBuilderQueryContainerInterface
     */
    public function getApiQueryBuilderQueryContainer(): CompanyUnitAddressApiToApiQueryBuilderQueryContainerInterface
    {
        return $this->getProvidedDependency(
            CompanyUnitAddressApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER,
        );
    }
}
