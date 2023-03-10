<?php

namespace FondOfOryx\Zed\CompanyDeleterProductListConnector\Business;

use FondOfOryx\Zed\CompanyDeleterProductListConnector\Business\Model\CompanyToProductListDeleter;
use FondOfOryx\Zed\CompanyDeleterProductListConnector\Business\Model\CompanyToProductListDeleterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterProductListConnector\Persistence\CompanyDeleterProductListConnectorEntityManagerInterface getEntityManager()
 */
class CompanyDeleterProductListConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyDeleterProductListConnector\Business\Model\CompanyToProductListDeleterInterface
     */
    public function createCompanyToProductListDeleter(): CompanyToProductListDeleterInterface
    {
        return new CompanyToProductListDeleter($this->getEntityManager());
    }
}
