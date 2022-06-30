<?php

namespace FondOfOryx\Zed\CustomerAddressSalesConnector\Business;

use FondOfOryx\Zed\CustomerAddressSalesConnector\Business\Writer\SalesOrderAddressWriter;
use FondOfOryx\Zed\CustomerAddressSalesConnector\Business\Writer\SalesOrderAddressWriterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CustomerAddressSalesConnector\Persistence\CustomerAddressSalesConnectorEntityManagerInterface getEntityManager()
 */
class CustomerAddressSalesConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CustomerAddressSalesConnector\Business\Writer\SalesOrderAddressWriterInterface
     */
    public function createSalesOrderAddressWriter(): SalesOrderAddressWriterInterface
    {
        return new SalesOrderAddressWriter($this->getEntityManager());
    }
}
