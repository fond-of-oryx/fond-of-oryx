<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Persistence;

use FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\SplittableCheckoutRestApiCompanyUnitAddressConnectorDependencyProvider;
use Orm\Zed\CompanyUnitAddress\Persistence\Base\SpyCompanyUnitAddressQuery;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Persistence\SplittableCheckoutRestApiCompanyUnitAddressConnectorRepositoryInterface getRepository()
 */
class SplittableCheckoutRestApiCompanyUnitAddressConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery
     */
    public function getCompanyUnitAddressToCompanyBusinessUnitQuery(): SpyCompanyUnitAddressToCompanyBusinessUnitQuery
    {
        return $this->getProvidedDependency(
            SplittableCheckoutRestApiCompanyUnitAddressConnectorDependencyProvider::PROPEL_QUERY_COMPANY_UNIT_ADDRESS_TO_COMPANY_BUSINESS_UNIT,
        );
    }

    /**
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\Base\SpyCompanyUnitAddressQuery
     */
    public function getCompanyUnitAddressQuery(): SpyCompanyUnitAddressQuery
    {
        return $this->getProvidedDependency(
            SplittableCheckoutRestApiCompanyUnitAddressConnectorDependencyProvider::PROPEL_QUERY_COMPANY_UNIT_ADDRESS,
        );
    }
}
