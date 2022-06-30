<?php

namespace FondOfOryx\Zed\CustomerAddressSalesConnector\Persistence;

use FondOfOryx\Zed\CustomerAddressSalesConnector\CustomerAddressSalesConnectorDependencyProvider;
use Orm\Zed\Sales\Persistence\Base\SpySalesOrderAddressQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 */
class CustomerAddressSalesConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Sales\Persistence\Base\SpySalesOrderAddressQuery
     */
    public function getSalesOrderAddressQuery(): SpySalesOrderAddressQuery
    {
        return $this->getProvidedDependency(
            CustomerAddressSalesConnectorDependencyProvider::PROPEL_QUERY_SALES_ORDER_ADDRESS,
        );
    }
}
