<?php

namespace FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business;

use FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business\Writer\SalesOrderAddressWriter;
use FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business\Writer\SalesOrderAddressWriterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Persistence\CompanyUnitAddressSalesConnectorEntityManagerInterface getEntityManager()
 */
class CompanyUnitAddressSalesConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business\Writer\SalesOrderAddressWriterInterface
     */
    public function createSalesOrderAddressWriter(): SalesOrderAddressWriterInterface
    {
        return new SalesOrderAddressWriter($this->getEntityManager());
    }
}
