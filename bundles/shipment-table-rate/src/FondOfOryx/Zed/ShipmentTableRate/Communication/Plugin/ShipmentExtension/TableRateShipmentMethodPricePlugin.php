<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Communication\Plugin\ShipmentExtension;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentGroupTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ShipmentExtension\Dependency\Plugin\ShipmentMethodPricePluginInterface;

/**
 * @method \FondOfOryx\Zed\ShipmentTableRate\Business\ShipmentTableRateFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ShipmentTableRate\ShipmentTableRateConfig getConfig()
 */
class TableRateShipmentMethodPricePlugin extends AbstractPlugin implements ShipmentMethodPricePluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ShipmentGroupTransfer $shipmentGroupTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return int
     */
    public function getPrice(ShipmentGroupTransfer $shipmentGroupTransfer, QuoteTransfer $quoteTransfer): int
    {
        return $this->getFacade()->calculatePrice($quoteTransfer, $shipmentGroupTransfer);
    }
}
