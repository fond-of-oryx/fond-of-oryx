<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business;

use FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business\Model\CompanyUnitAddressDeleter;
use FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business\Model\CompanyUnitAddressDeleterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Persistence\CompanyDeleterCompanyUnitAddressConnectorEntityManagerInterface getEntityManager()
 */
class CompanyDeleterCompanyUnitAddressConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business\Model\CompanyUnitAddressDeleterInterface
     */
    public function createCompanyUnitAddressDeleter(): CompanyUnitAddressDeleterInterface
    {
        return new CompanyUnitAddressDeleter($this->getEntityManager());
    }
}
