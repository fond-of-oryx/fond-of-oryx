<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business;

use FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business\Model\BusinessUnitDeleter;
use FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business\Model\BusinessUnitDeleterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Persistence\CompanyDeleterCompanyBusinessUnitConnectorEntityManagerInterface getEntityManager()
 */
class CompanyDeleterCompanyBusinessUnitConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business\Model\BusinessUnitDeleterInterface
     */
    public function createBusinessUnitDeleter(): BusinessUnitDeleterInterface
    {
        return new BusinessUnitDeleter($this->getEntityManager());
    }
}
