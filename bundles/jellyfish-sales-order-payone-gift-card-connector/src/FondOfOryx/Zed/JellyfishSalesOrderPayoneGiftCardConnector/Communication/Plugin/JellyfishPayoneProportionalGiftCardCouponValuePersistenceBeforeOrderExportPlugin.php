<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Communication\Plugin;

use FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderBeforeExportPluginInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\JellyfishSalesOrderPayoneGiftCardConnectorFacadeInterface getFacade()
 */
class JellyfishPayoneProportionalGiftCardCouponValuePersistenceBeforeOrderExportPlugin extends AbstractPlugin implements JellyfishOrderBeforeExportPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param array $options
     *
     * @return void
     */
    public function before(JellyfishOrderTransfer $jellyfishOrderTransfer, array $options): void
    {
        if ($this->getFacade()->isPayonePayment($jellyfishOrderTransfer) === false) {
            return;
        }

        $this->getFacade()->persistProportionalCouponValues($jellyfishOrderTransfer);
    }
}
