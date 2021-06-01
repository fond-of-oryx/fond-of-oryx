<?php

namespace FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Plugin;

use FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderExpanderPostMapPluginInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class JellyfishCrossEngageOrderExpanderPlugin implements JellyfishOrderExpanderPostMapPluginInterface
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
        if (method_exists($salesOrder, 'getIp')) {
            $jellyfishOrderTransfer->setIp($salesOrder->getIp());
        }

        if (method_exists($salesOrder, 'getOptInUrl')) {
            $jellyfishOrderTransfer->setOptInUrl($salesOrder->getOptInUrl());
        }

        if (method_exists($salesOrder, 'getOptOutUrl')) {
            $jellyfishOrderTransfer->setOptOutUrl($salesOrder->getOptOutUrl());
        }

        if (method_exists($salesOrder, 'getUserHash')) {
            $jellyfishOrderTransfer->setUserHash($salesOrder->getUserHash());
        }

        if (method_exists($salesOrder, 'getSignupNewsletter')) {
            $jellyfishOrderTransfer->setSignupNewsletter($salesOrder->getSignupNewsletter());
        }

        if (method_exists($salesOrder, 'getGender')) {
            $jellyfishOrderTransfer->setGender($salesOrder->getGender());
        }

        if (method_exists($salesOrder, 'getSalutation')) {
            $jellyfishOrderTransfer->setSalutation($salesOrder->getSalutation());
        }

        return $jellyfishOrderTransfer;
    }
}
