<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiShipmentConnector\Business\Expander;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Generated\Shared\Transfer\ShipmentMethodTransfer;

class QuoteExpander implements QuoteExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        $restShipmentTransfer = $restSplittableCheckoutRequestTransfer->getShipment();

        if ($restShipmentTransfer === null || $restShipmentTransfer->getIdShipmentMethod() === null) {
            return $quoteTransfer;
        }

        $shipmentMethodTransfer = (new ShipmentMethodTransfer())
            ->setIdShipmentMethod($restShipmentTransfer->getIdShipmentMethod());

        return $this->expandWithShipmentMethod($quoteTransfer, $shipmentMethodTransfer);
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
}
