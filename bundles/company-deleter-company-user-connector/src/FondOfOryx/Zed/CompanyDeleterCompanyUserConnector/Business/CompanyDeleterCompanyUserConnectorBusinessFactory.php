<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Business;

use FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Business\Model\CompanyUserDeleter;
use FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Business\Model\CompanyUserDeleterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Persistence\CompanyDeleterCompanyUserConnectorEntityManagerInterface getEntityManager()
 */
class CompanyDeleterCompanyUserConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Business\Model\CompanyUserDeleterInterface
     */
    public function createCompanyUserDeleter(): CompanyUserDeleterInterface
    {
        return new CompanyUserDeleter($this->getEntityManager());
    }
}
