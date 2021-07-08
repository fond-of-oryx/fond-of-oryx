<?php

namespace FondOfOryx\Zed\JellyfishThirtyFiveUp\Communication\Plugin;

use FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderExpanderPostMapPluginInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * Class JellyfishThirtyFiveUpOrderExpanderPlugin
 *
 * @package FondOfOryx\Zed\JellyfishThirtyFiveUp\Dependency\Plugin
 *
 * @method \FondOfOryx\Zed\JellyfishThirtyFiveUp\Communication\JellyfishThirtyFiveUpCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\JellyfishThirtyFiveUp\JellyfishThirtyFiveUpConfig getConfig()
 * @method \FondOfOryx\Zed\JellyfishThirtyFiveUp\Business\JellyfishThirtyFiveUpFacadeInterface getFacade()
 */
class JellyfishThirtyFiveUpOrderExpanderPlugin extends AbstractPlugin implements JellyfishOrderExpanderPostMapPluginInterface
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
        $thirtyFiveUpOrder = $salesOrder->getFooThirtyFiveUpOrder();

        if ($thirtyFiveUpOrder !== null) {
            $thirtyFiveUpOrderTransfer = $this->getFactory()->getThirtyFiveUpFacade()->convertThirtyFiveUpOrderEntityToTransfer($thirtyFiveUpOrder);
            $jellyfishOrderTransfer->setThirtyFiveUpOrder($thirtyFiveUpOrderTransfer);
        }

        return $jellyfishOrderTransfer;
    }
}
