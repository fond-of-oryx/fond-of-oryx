<?php

namespace FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business;

use FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business\Model\ErpDeliveryNoteDeleter;
use FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business\Model\ErpDeliveryNoteDeleterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Persistence\CompanyDeleterErpDeliveryNoteConnectorEntityManagerInterface getEntityManager()
 */
class CompanyDeleterErpDeliveryNoteConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business\Model\ErpDeliveryNoteDeleterInterface
     */
    public function createErpDeliveryNoteDeleter(): ErpDeliveryNoteDeleterInterface
    {
        return new ErpDeliveryNoteDeleter($this->getEntityManager());
    }
}
