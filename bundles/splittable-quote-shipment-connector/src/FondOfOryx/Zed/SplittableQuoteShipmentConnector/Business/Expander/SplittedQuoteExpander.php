<?php

namespace FondOfOryx\Zed\SplittableQuoteShipmentConnector\Business\Expander;

use FondOfOryx\Zed\SplittableQuoteShipmentConnector\Dependency\Facade\SplittableQuoteShipmentConnectorToShipmentFacadeInterface;
use Generated\Shared\Transfer\ExpenseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentMethodTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use Spryker\Shared\Shipment\ShipmentConfig;

class SplittedQuoteExpander implements SplittedQuoteExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableQuoteShipmentConnector\Dependency\Facade\SplittableQuoteShipmentConnectorToShipmentFacadeInterface
     */
    protected $shipmentFacade;

    /**
     * @param \FondOfOryx\Zed\SplittableQuoteShipmentConnector\Dependency\Facade\SplittableQuoteShipmentConnectorToShipmentFacadeInterface $shipmentFacade
     */
    public function __construct(SplittableQuoteShipmentConnectorToShipmentFacadeInterface $shipmentFacade)
    {
        $this->shipmentFacade = $shipmentFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $splittedQuoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(QuoteTransfer $splittedQuoteTransfer): QuoteTransfer
    {
        $shipmentTransfer = $splittedQuoteTransfer->getShipment();

        if ($shipmentTransfer === null) {
            return $splittedQuoteTransfer;
        }

        $idShipmentMethod = $this->getIdShipmentMethodByShipment($shipmentTransfer);

        if ($idShipmentMethod === null) {
            return $splittedQuoteTransfer;
        }

        $shipmentMethodTransfer = $this->shipmentFacade->findAvailableMethodById(
            $idShipmentMethod,
            $splittedQuoteTransfer
        );

        if ($shipmentMethodTransfer === null) {
            return $splittedQuoteTransfer;
        }

        $splittedQuoteTransfer = $this->expandWithShipmentMethod($splittedQuoteTransfer, $shipmentMethodTransfer);

        return $this->expandWithExpense($splittedQuoteTransfer, $shipmentMethodTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentTransfer $shipmentTransfer
     *
     * @return int|null
     */
    protected function getIdShipmentMethodByShipment(ShipmentTransfer $shipmentTransfer): ?int
    {
        $shipmentMethodTransfer = $shipmentTransfer->getMethod();

        if ($shipmentMethodTransfer === null) {
            return null;
        }

        return $shipmentMethodTransfer->getIdShipmentMethod();
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
}
