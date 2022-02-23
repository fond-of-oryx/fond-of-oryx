<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderOrderCustomReference\Communication\Plugin\JellyfishSalesOrderExtension;

use FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderExpanderPostMapPluginInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class CustomReferenceJellyfishOrderExpanderPostMapPlugin extends AbstractPlugin implements JellyfishOrderExpanderPostMapPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function expand(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        SpySalesOrder $salesOrder
    ): JellyfishOrderTransfer {
        $orderCustomReference = $salesOrder->getOrderCustomReference();

        if ($orderCustomReference === null) {
            return $jellyfishOrderTransfer;
        }

        return $jellyfishOrderTransfer->setCustomReference($orderCustomReference);
    }
}
