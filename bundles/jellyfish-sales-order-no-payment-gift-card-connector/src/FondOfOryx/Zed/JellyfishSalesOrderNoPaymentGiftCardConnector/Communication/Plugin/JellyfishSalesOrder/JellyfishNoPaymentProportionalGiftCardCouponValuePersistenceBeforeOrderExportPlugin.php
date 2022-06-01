<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Communication\Plugin\JellyfishSalesOrder;

use FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderBeforeExportPluginInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Business\JellyfishSalesOrderNoPaymentGiftCardConnectorFacadeInterface getFacade()
 */
class JellyfishNoPaymentProportionalGiftCardCouponValuePersistenceBeforeOrderExportPlugin extends AbstractPlugin implements JellyfishOrderBeforeExportPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param array $options
     *
     * @return void
     */
    public function before(JellyfishOrderTransfer $jellyfishOrderTransfer, array $options): void
    {
        if ($this->getFacade()->isOnlyGiftCardPayment($jellyfishOrderTransfer) === false) {
            return;
        }

        $this->getFacade()->persistProportionalCouponValues($jellyfishOrderTransfer);
    }
}
