<?php

namespace FondOfOryx\Zed\SalesLocaleConnector\Communication\Plugin\Sales;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Sales\Dependency\Plugin\HydrateOrderPluginInterface;

/**
 * @method \FondOfSpryker\Zed\SalesLocaleConnector\Business\SalesLocaleConnectorFacadeInterface getFacade()
 */
class LocaleOrderHydrationPlugin extends AbstractPlugin implements HydrateOrderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function hydrate(OrderTransfer $orderTransfer): OrderTransfer
    {
        return $this->getFacade()->expandOrder($orderTransfer);
    }
}
