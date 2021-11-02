<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence;

use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence\Propel\Mapper\CompanyUnitAddressMapper;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence\Propel\Mapper\CompanyUnitAddressMapperInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\ReturnLabelsRestApiCompanyUnitAddressConnectorDependencyProvider;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence\ReturnLabelsRestApiCompanyUnitAddressConnectorRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\ReturnLabelsRestApiCompanyUnitAddressConnectorConfig getConfig()
 */
class ReturnLabelsRestApiCompanyUnitAddressConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery
     */
    public function getCompanyUnitAddressQuery(): SpyCompanyUnitAddressQuery
    {
        return $this->getProvidedDependency(
            ReturnLabelsRestApiCompanyUnitAddressConnectorDependencyProvider::PROPEL_QUERY_COMPANY_UNIT_ADDRESS,
        );
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence\Propel\Mapper\CompanyUnitAddressMapperInterface
     */
    public function createCompanyUnitAddressMapper(): CompanyUnitAddressMapperInterface
    {
        return new CompanyUnitAddressMapper();
    }
}
