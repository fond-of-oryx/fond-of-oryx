<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\PluginExecutor;

use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class JellyfishSalesOrderPluginExecutor implements JellyfishSalesOrderPluginExecutorInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderPostMapPluginInterface[]
     */
    protected $jellyfishOrderPostMapPlugins;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderPostMapPluginInterface[] $jellyfishOrderPostMapPlugins
     */
    public function __construct(array $jellyfishOrderPostMapPlugins)
    {
        $this->jellyfishOrderPostMapPlugins = $jellyfishOrderPostMapPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function executePostMapPlugins(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        SpySalesOrder $salesOrder
    ): JellyfishOrderTransfer {
        foreach ($this->jellyfishOrderPostMapPlugins as $plugin) {
            $jellyfishOrderTransfer = $plugin->postMap($jellyfishOrderTransfer, $salesOrder);
        }

        return $jellyfishOrderTransfer;
    }
}
