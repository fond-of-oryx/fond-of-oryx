<?php

namespace FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Business;

use FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Business\Model\ErpOrderDeleter;
use FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Business\Model\ErpOrderDeleterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Persistence\CompanyDeleterErpOrderConnectorEntityManagerInterface getEntityManager()
 */
class CompanyDeleterErpOrderConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Business\Model\ErpOrderDeleterInterface
     */
    public function createErpOrderDeleter(): ErpOrderDeleterInterface
    {
        return new ErpOrderDeleter($this->getEntityManager());
    }
}
