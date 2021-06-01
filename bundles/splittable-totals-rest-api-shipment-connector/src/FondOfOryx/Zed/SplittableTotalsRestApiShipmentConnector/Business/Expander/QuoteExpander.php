<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\Expander;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\ShipmentMethodTransfer;

class QuoteExpander implements QuoteExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        $restShipmentTransfer = $restSplittableTotalsRequestTransfer->getShipment();

        if ($restShipmentTransfer === null || $restShipmentTransfer->getIdShipmentMethod() === null) {
            return $quoteTransfer;
        }

        $shipmentMethodTransfer = (new ShipmentMethodTransfer())
            ->setIdShipmentMethod($restShipmentTransfer->getIdShipmentMethod());

        $quoteTransfer = $this->expandWithShipmentMethod($quoteTransfer, $shipmentMethodTransfer);

        return $this->expandItemsWithShipmentMethod($quoteTransfer, $shipmentMethodTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ShipmentMethodTransfer $shipmentMethodTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function expandWithShipmentMethod(
        QuoteTransfer $quoteTransfer,
        ShipmentMethodTransfer $shipmentMethodTransfer
    ): QuoteTransfer {
        $shipmentTransfer = $quoteTransfer->getShipment();

        if ($shipmentTransfer === null) {
            return $quoteTransfer;
        }

        $shipmentTransfer->setMethod($shipmentMethodTransfer);

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ShipmentMethodTransfer $shipmentMethodTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function expandItemsWithShipmentMethod(
        QuoteTransfer $quoteTransfer,
        ShipmentMethodTransfer $shipmentMethodTransfer
    ): QuoteTransfer {
        foreach ($quoteTransfer->getItems() as $item) {
            if ($item->getShipment() === null) {
                continue;
            }

            $item->getShipment()->setMethod($shipmentMethodTransfer);
        }

        return $quoteTransfer;
    }
}
