<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Communication\Controller;

use Generated\Shared\Transfer\ErpOrderCollectionTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Business\ErpOrderPageSearchFacade getFacade()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Communication\ErpOrderPageSearchCommunicationFactory getFactory()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @return \Generated\Shared\Transfer\ErpOrderCollectionTransfer
     */
    public function getErpOrderByRequestAction(): ErpOrderCollectionTransfer
    {
        return $this->getFacade()
            ->getErpOrderByRequest();
    }
}
