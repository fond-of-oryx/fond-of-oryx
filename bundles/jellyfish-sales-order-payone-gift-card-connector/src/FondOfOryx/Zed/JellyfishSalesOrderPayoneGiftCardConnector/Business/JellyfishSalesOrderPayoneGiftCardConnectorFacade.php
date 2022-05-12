<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business;

use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\JellyfishSalesOrderPayoneGiftCardConnectorBusinessFactory getFactory()
 */
class JellyfishSalesOrderPayoneGiftCardConnectorFacade extends AbstractFacade implements JellyfishSalesOrderPayoneGiftCardConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param int $idSalesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function calculateProportionalGiftCardValues(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        int $idSalesOrder
    ): JellyfishOrderTransfer {
        return $this->getFactory()->createProportionalGiftCardValueCalculator()->calculate($jellyfishOrderTransfer, $idSalesOrder);
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     *
     * @return void
     */
    public function persistProportionalCouponValues(
        JellyfishOrderTransfer $jellyfishOrderTransfer
    ): void {
        $this->getFactory()->createProportionalGiftCardValueManager()->persistProportionalGiftCardValuesFromExport($jellyfishOrderTransfer);
    }

    /**
     * @param array<\Generated\Shared\Transfer\ItemTransfer> $itemTransfers
     *
     * @return array<\Generated\Shared\Transfer\ItemTransfer>
     */
    public function expandOrderItems(array $itemTransfers): array
    {
        return $this->getFactory()->createOrderItemsExpander()->expand($itemTransfers);
    }
}
