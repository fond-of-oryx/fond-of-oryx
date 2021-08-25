<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Dependency\Plugin\JellyfishSalesOrder;

use FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderItemExpanderPostMapPluginInterface;
use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\JellyfishSalesOrderGiftCardConnectorFacadeInterface getFacade()
 */
class JellyfishSalesOrderGiftCardConnectorOrderItemExpanderPlugin extends AbstractPlugin implements JellyfishOrderItemExpanderPostMapPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderItemTransfer $jellyfishOrderItemTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $salesOrderItem
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderItemTransfer
     */
    public function expand(
        JellyfishOrderItemTransfer $jellyfishOrderItemTransfer,
        SpySalesOrderItem $salesOrderItem
    ): JellyfishOrderItemTransfer {
        return $this->getFacade()->expand($jellyfishOrderItemTransfer, $salesOrderItem);
    }
}
