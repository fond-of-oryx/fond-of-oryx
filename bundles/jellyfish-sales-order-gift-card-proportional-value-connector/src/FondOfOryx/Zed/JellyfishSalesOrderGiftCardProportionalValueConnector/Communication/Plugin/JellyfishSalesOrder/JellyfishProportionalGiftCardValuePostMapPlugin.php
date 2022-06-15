<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Communication\Plugin\JellyfishSalesOrder;

use FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderPostMapPluginInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\JellyfishSalesOrderGiftCardProportionalValueConnectorFacadeInterface getFacade()
 */
class JellyfishProportionalGiftCardValuePostMapPlugin extends AbstractPlugin implements JellyfishOrderPostMapPluginInterface
{
    /**
     * Specification:
     *  - Allows to manipulate JellyfishOrderTransfer object after mapping.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function postMap(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        SpySalesOrder $salesOrder
    ): JellyfishOrderTransfer {
        return $this->getFacade()->mapProportionalGiftCardValues($jellyfishOrderTransfer, $salesOrder);
    }
}
