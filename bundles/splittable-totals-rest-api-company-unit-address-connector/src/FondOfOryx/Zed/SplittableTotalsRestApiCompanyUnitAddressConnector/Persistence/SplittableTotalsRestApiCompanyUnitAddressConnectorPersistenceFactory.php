<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Persistence;

use FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\SplittableTotalsRestApiCompanyUnitAddressConnectorDependencyProvider;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Persistence\SplittableTotalsRestApiCompanyUnitAddressConnectorRepositoryInterface getRepository()
 */
class SplittableTotalsRestApiCompanyUnitAddressConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery
     */
    public function getCompanyUnitAddressToCompanyBusinessUnitQuery(): SpyCompanyUnitAddressToCompanyBusinessUnitQuery
    {
        return $this->getProvidedDependency(
            SplittableTotalsRestApiCompanyUnitAddressConnectorDependencyProvider::PROPEL_QUERY_COMPANY_UNIT_ADDRESS_TO_COMPANY_BUSINESS_UNIT
        );
    }
}
