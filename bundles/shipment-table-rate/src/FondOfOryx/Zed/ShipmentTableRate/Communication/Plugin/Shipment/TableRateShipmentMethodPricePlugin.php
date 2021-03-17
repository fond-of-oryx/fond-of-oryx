<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Communication\Plugin\Shipment;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Shipment\Communication\Plugin\ShipmentMethodPricePluginInterface;

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
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return int
     */
    public function getPrice(QuoteTransfer $quoteTransfer): int
    {
        return $this->getFacade()->calculatePrice($quoteTransfer);
    }
}
