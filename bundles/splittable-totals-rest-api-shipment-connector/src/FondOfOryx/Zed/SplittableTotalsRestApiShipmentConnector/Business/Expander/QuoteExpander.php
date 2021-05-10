<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\Expander;

use FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Dependency\Facade\SplittableTotalsRestApiShipmentConnectorToShipmentFacadeInterface;
use Generated\Shared\Transfer\ExpenseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\ShipmentMethodTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use Spryker\Shared\Shipment\ShipmentConfig;

class QuoteExpander implements QuoteExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Dependency\Facade\SplittableTotalsRestApiShipmentConnectorToShipmentFacadeInterface
     */
    protected $shipmentFacade;

    /**
     * @param \FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Dependency\Facade\SplittableTotalsRestApiShipmentConnectorToShipmentFacadeInterface $shipmentFacade
     */
    public function __construct(SplittableTotalsRestApiShipmentConnectorToShipmentFacadeInterface $shipmentFacade)
    {
        $this->shipmentFacade = $shipmentFacade;
    }

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

        $shipmentMethodTransfer = $this->shipmentFacade->findAvailableMethodById(
            $restShipmentTransfer->getIdShipmentMethod(),
            $quoteTransfer
        );

        if ($shipmentMethodTransfer === null) {
            return $quoteTransfer;
        }

        $quoteTransfer = $this->expandWithShipmentMethod($quoteTransfer, $shipmentMethodTransfer);
        $quoteTransfer = $this->expandItemsWithShipmentMethod($quoteTransfer, $shipmentMethodTransfer);

        return $this->expandWithExpense($quoteTransfer, $shipmentMethodTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ShipmentMethodTransfer $shipmentMethodTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function expandWithExpense(
        QuoteTransfer $quoteTransfer,
        ShipmentMethodTransfer $shipmentMethodTransfer
    ): QuoteTransfer {
        $shipmentTransfer = (new ShipmentTransfer())
            ->setMethod($shipmentMethodTransfer)
            ->setShipmentSelection((string)$shipmentMethodTransfer->getIdShipmentMethod())
            ->setShippingAddress($quoteTransfer->getShippingAddress());

        $expenseTransfer = (new ExpenseTransfer())
            ->fromArray($shipmentMethodTransfer->toArray(), true)
            ->setType(ShipmentConfig::SHIPMENT_EXPENSE_TYPE)
            ->setUnitNetPrice($shipmentMethodTransfer->getStoreCurrencyPrice())
            ->setUnitGrossPrice($shipmentMethodTransfer->getStoreCurrencyPrice())
            ->setQuantity(1)
            ->setShipment($shipmentTransfer);

        return $quoteTransfer->addExpense($expenseTransfer);
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
