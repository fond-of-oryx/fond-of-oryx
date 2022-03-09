<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderVatId\Communication\Plugin\JellyfishSalesOrderExtension;

use FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderExpanderPostMapPluginInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class VatIdJellyfishOrderExpanderPostMapPlugin extends AbstractPlugin implements JellyfishOrderExpanderPostMapPluginInterface
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
        $shippingAddress = $salesOrder->getShippingAddress();

        if ($shippingAddress === null || $shippingAddress->getVatId() === null) {
            return $jellyfishOrderTransfer;
        }

        return $jellyfishOrderTransfer->setVatId($shippingAddress->getVatId());
    }
}
