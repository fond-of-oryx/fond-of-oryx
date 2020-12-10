<?php

namespace FondOfOryx\Zed\SalesLocaleConnector\Communication\Plugin\SalesExtension;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SalesExtension\Dependency\Plugin\OrderExpanderPluginInterface;

/**
 * @method \FondOfOryx\Zed\SalesLocaleConnector\Business\SalesLocaleConnectorFacadeInterface getFacade()
 */
class LocaleOrderExpanderPlugin extends AbstractPlugin implements OrderExpanderPluginInterface
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
