<?php

namespace FondOfOryx\Zed\ReturnLabel\Persistence;

use FondOfOryx\Zed\ReturnLabel\Persistence\Propel\Mapper\CompanyBusinessUnitMapper;
use FondOfOryx\Zed\ReturnLabel\Persistence\Propel\Mapper\CompanyBusinessUnitMapperInterface;
use FondOfOryx\Zed\ReturnLabel\Persistence\Propel\Mapper\CompanyMapper;
use FondOfOryx\Zed\ReturnLabel\Persistence\Propel\Mapper\CompanyMapperInterface;
use FondOfOryx\Zed\ReturnLabel\Persistence\Propel\Mapper\CompanyUnitAddressMapper;
use FondOfOryx\Zed\ReturnLabel\Persistence\Propel\Mapper\CompanyUnitAddressMapperInterface;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelDependencyProvider;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig getConfig()
 * @method \FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelRepositoryInterface getRepository()
 */
class ReturnLabelPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery
     */
    public function getCompanyUnitAddressQuery(): SpyCompanyUnitAddressQuery
    {
        return $this->getProvidedDependency(ReturnLabelDependencyProvider::PROPEL_QUERY_COMPANY_UNIT_ADDRESS);
    }

    /**
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery
     */
    public function getCompanyBusinessUnitQuery(): SpyCompanyBusinessUnitQuery
    {
        return $this->getProvidedDependency(ReturnLabelDependencyProvider::PROPEL_QUERY_COMPANY_BUSINESS_UNIT);
    }

    /**
     * @return \Orm\Zed\Company\Persistence\SpyCompanyQuery
     */
    public function getCompanyQuery(): SpyCompanyQuery
    {
        return $this->getProvidedDependency(ReturnLabelDependencyProvider::PROPEL_QUERY_COMPANY);
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabel\Persistence\Propel\Mapper\CompanyUnitAddressMapperInterface
     */
    public function createCompanyUnitAddressMapper(): CompanyUnitAddressMapperInterface
    {
        return new CompanyUnitAddressMapper();
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabel\Persistence\Propel\Mapper\CompanyBusinessUnitMapperInterface
     */
    public function createCompanyBusinessUnitMapper(): CompanyBusinessUnitMapperInterface
    {
        return new CompanyBusinessUnitMapper();
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabel\Persistence\Propel\Mapper\CompanyMapperInterface
     */
    public function createCompanyMapper(): CompanyMapperInterface
    {
        return new CompanyMapper();
    }
}
