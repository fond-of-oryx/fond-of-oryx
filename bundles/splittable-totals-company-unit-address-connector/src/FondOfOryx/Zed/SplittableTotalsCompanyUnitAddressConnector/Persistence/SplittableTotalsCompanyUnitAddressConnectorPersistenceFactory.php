<?php

namespace FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Persistence;

use FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\SplittableTotalsCompanyUnitAddressConnectorDependencyProvider;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Persistence\SplittableTotalsCompanyUnitAddressConnectorRepositoryInterface getRepository()
 */
class SplittableTotalsCompanyUnitAddressConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery
     */
    public function getCompanyUnitAddressToCompanyBusinessUnitQuery(): SpyCompanyUnitAddressToCompanyBusinessUnitQuery
    {
        return $this->getProvidedDependency(
            SplittableTotalsCompanyUnitAddressConnectorDependencyProvider::PROPEL_QUERY_COMPANY_UNIT_ADDRESS_TO_COMPANY_BUSINESS_UNIT
        );
    }
}
