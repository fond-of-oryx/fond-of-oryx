<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Business;

use FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Business\Model\CompanyRoleDeleter;
use FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Business\Model\CompanyRoleDeleterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Persistence\CompanyDeleterCompanyRoleConnectorEntityManagerInterface getEntityManager()
 */
class CompanyDeleterCompanyRoleConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Business\Model\CompanyRoleDeleterInterface
     */
    public function createCompanyRoleDeleter(): CompanyRoleDeleterInterface
    {
        return new CompanyRoleDeleter($this->getEntityManager());
    }
}
