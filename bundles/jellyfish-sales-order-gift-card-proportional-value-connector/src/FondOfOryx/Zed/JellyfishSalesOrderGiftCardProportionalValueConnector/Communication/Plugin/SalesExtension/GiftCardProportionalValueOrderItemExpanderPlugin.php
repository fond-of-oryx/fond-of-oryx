<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Communication\Plugin\SalesExtension;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SalesExtension\Dependency\Plugin\OrderItemExpanderPluginInterface;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\JellyfishSalesOrderGiftCardProportionalValueConnectorFacadeInterface getFacade()
 */
class GiftCardProportionalValueOrderItemExpanderPlugin extends AbstractPlugin implements OrderItemExpanderPluginInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\ItemTransfer> $itemTransfers
     *
     * @return array<\Generated\Shared\Transfer\ItemTransfer>
     */
    public function expand(array $itemTransfers): array
    {
        return $this->getFacade()->expandOrderItems($itemTransfers);
    }
}
