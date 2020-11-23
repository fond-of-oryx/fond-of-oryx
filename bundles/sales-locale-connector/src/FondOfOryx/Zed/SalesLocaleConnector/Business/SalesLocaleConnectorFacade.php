<?php

namespace FondOfOryx\Zed\SalesLocaleConnector\Business;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\SalesLocaleConnector\Business\SalesLocaleConnectorBusinessFactory getFactory()
 */
class SalesLocaleConnectorFacade extends AbstractFacade implements SalesLocaleConnectorFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function expandOrder(OrderTransfer $orderTransfer): OrderTransfer
    {
        return $this->getFactory()->createOrderExpander()->expand($orderTransfer);
    }
}
