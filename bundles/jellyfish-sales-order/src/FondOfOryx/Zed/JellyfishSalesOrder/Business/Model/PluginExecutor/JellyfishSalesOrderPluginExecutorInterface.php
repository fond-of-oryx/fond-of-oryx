<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\PluginExecutor;

use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface JellyfishSalesOrderPluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function executePostMapPlugins(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        SpySalesOrder $salesOrder
    ): JellyfishOrderTransfer;
}
