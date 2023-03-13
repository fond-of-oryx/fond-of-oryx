<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Business;

use FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Business\Model\CompanyToProductListDeleter;
use FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Business\Model\CompanyToProductListDeleterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Persistence\CompanyDeleterCompanyToProductListConnectorEntityManagerInterface getEntityManager()
 */
class CompanyDeleterCompanyToProductListConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Business\Model\CompanyToProductListDeleterInterface
     */
    public function createCompanyToProductListDeleter(): CompanyToProductListDeleterInterface
    {
        return new CompanyToProductListDeleter($this->getEntityManager());
    }
}
