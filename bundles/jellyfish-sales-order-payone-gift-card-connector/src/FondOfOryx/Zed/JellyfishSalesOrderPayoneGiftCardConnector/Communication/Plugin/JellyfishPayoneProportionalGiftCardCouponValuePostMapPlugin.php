<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Communication\Plugin;

use FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderPostMapPluginInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\JellyfishSalesOrderPayoneGiftCardConnectorFacadeInterface getFacade()
 */
class JellyfishPayoneProportionalGiftCardCouponValuePostMapPlugin extends AbstractPlugin implements JellyfishOrderPostMapPluginInterface
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
        if ($this->getFacade()->isPayonePayment($jellyfishOrderTransfer) === false) {
            return $jellyfishOrderTransfer;
        }

        return $this->getFacade()->calculateProportionalGiftCardValues($jellyfishOrderTransfer, $salesOrder->getIdSalesOrder());
    }
}
