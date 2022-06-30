<?php

namespace FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Persistence;

use FondOfOryx\Zed\CompanyUnitAddressSalesConnector\CompanyUnitAddressSalesConnectorDependencyProvider;
use Orm\Zed\Sales\Persistence\Base\SpySalesOrderAddressQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 */
class CompanyUnitAddressSalesConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Sales\Persistence\Base\SpySalesOrderAddressQuery
     */
    public function getSalesOrderAddressQuery(): SpySalesOrderAddressQuery
    {
        return $this->getProvidedDependency(
            CompanyUnitAddressSalesConnectorDependencyProvider::PROPEL_QUERY_SALES_ORDER_ADDRESS,
        );
    }
}
