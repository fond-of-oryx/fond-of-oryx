<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitAddressSearchRestApi\Persistence;

use FondOfOryx\Zed\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiDependencyProvider;
use FondOfOryx\Zed\CompanyBusinessUnitAddressSearchRestApi\Persistence\Propel\Mapper\CompanyBusinessUnitAddressMapper;
use FondOfOryx\Zed\CompanyBusinessUnitAddressSearchRestApi\Persistence\Propel\Mapper\CompanyBusinessUnitAddressMapperInterface;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\CompanyBusinessUnitAddressSearchRestApi\Persistence\CompanyBusinessUnitAddressSearchRestApiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConfig getConfig()
 */
class CompanyBusinessUnitAddressSearchRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery
     */
    public function getCompanyUnitAddressQuery(): SpyCompanyUnitAddressQuery
    {
        return $this->getProvidedDependency(CompanyBusinessUnitAddressSearchRestApiDependencyProvider::PROPEL_QUERY_COMPANY_UNIT_ADDRESS);
    }

    /**
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery
     */
    public function getCompanyBusinessUnitQuery(): SpyCompanyBusinessUnitQuery
    {
        return $this->getProvidedDependency(CompanyBusinessUnitAddressSearchRestApiDependencyProvider::PROPEL_QUERY_COMPANY_BUSINESS_UNIT);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitAddressSearchRestApi\Persistence\Propel\Mapper\CompanyBusinessUnitAddressMapperInterface
     */
    public function createCompanyBusinessUnitAddressMapper(): CompanyBusinessUnitAddressMapperInterface
    {
        return new CompanyBusinessUnitAddressMapper();
    }
}
