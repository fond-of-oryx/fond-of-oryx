<?php

namespace FondOfOryx\Zed\ReturnLabel\Persistence;

use FondOfOryx\Zed\ReturnLabel\Persistence\Propel\Mapper\CompanyUnitAddressMapper;
use FondOfOryx\Zed\ReturnLabel\Persistence\Propel\Mapper\CompanyUnitAddressMapperInterface;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelDependencyProvider;
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
     * @return \FondOfOryx\Zed\ReturnLabel\Persistence\Propel\Mapper\CompanyUnitAddressMapperInterface
     */
    public function createCompanyUnitAddressMapper(): CompanyUnitAddressMapperInterface
    {
        return new CompanyUnitAddressMapper();
    }
}
