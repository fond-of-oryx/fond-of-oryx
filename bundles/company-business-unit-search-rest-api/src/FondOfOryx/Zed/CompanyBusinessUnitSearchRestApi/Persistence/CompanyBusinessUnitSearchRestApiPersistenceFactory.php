<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitSearchRestApi\Persistence;

use FondOfOryx\Zed\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiDependencyProvider;
use FondOfOryx\Zed\CompanyBusinessUnitSearchRestApi\Persistence\Propel\Mapper\CompanyBusinessUnitMapper;
use FondOfOryx\Zed\CompanyBusinessUnitSearchRestApi\Persistence\Propel\Mapper\CompanyBusinessUnitMapperInterface;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\CompanyBusinessUnitSearchRestApi\Persistence\CompanyBusinessUnitSearchRestApiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiConfig getConfig()
 */
class CompanyBusinessUnitSearchRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery
     */
    public function getCompanyBusinessUnitQuery(): SpyCompanyBusinessUnitQuery
    {
        return $this->getProvidedDependency(CompanyBusinessUnitSearchRestApiDependencyProvider::PROPEL_QUERY_COMPANY_BUSINESS_UNIT);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitSearchRestApi\Persistence\Propel\Mapper\CompanyBusinessUnitMapperInterface
     */
    public function createCompanyBusinessUnitMapper(): CompanyBusinessUnitMapperInterface
    {
        return new CompanyBusinessUnitMapper();
    }
}
