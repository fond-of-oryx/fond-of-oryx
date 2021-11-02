<?php

namespace FondOfOryx\Zed\ShipmentCartCodeConnector\Business\Sanitizer;

use ArrayObject;
use Generated\Shared\Transfer\QuoteTransfer;

class ShipmentSanitizer implements ShipmentSanitizerInterface
{
    /**
     * @uses \Spryker\Shared\Shipment\ShipmentConfig::SHIPMENT_EXPENSE_TYPE
     *
     * @var string
     */
    protected const SHIPMENT_EXPENSE_TYPE = 'SHIPMENT_EXPENSE_TYPE';

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function sanitize(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $quoteTransfer = $this->sanitizeQuoteLevelShipmentMethod($quoteTransfer);
        $quoteTransfer = $this->sanitizeQuoteItemLevelShipmentMethod($quoteTransfer);

        return $this->sanitizeShipmentExpenses($quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function sanitizeQuoteLevelShipmentMethod(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        if (!method_exists($quoteTransfer, 'getShipment')) {
            return $quoteTransfer;
        }

        if ($quoteTransfer->getShipment() !== null) {
            $quoteTransfer->getShipment()->setMethod(null);
        }

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function sanitizeQuoteItemLevelShipmentMethod(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            if (!method_exists($itemTransfer, 'getShipment')) {
                break;
            }

            if ($itemTransfer->getShipment() !== null) {
                $itemTransfer->getShipment()->setMethod(null);
            }
        }

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function sanitizeShipmentExpenses(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $expenseTransfers = new ArrayObject();

        foreach ($quoteTransfer->getExpenses() as $expenseTransfer) {
            if ($expenseTransfer->getType() !== static::SHIPMENT_EXPENSE_TYPE) {
                $expenseTransfers->append($expenseTransfer);
            }
        }

        return $quoteTransfer->setExpenses($expenseTransfers);
    }
}
