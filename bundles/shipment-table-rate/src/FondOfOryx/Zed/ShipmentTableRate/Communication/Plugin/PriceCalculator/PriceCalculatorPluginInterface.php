<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Communication\Plugin\PriceCalculator;

use Generated\Shared\Transfer\QuoteTransfer;

interface PriceCalculatorPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function calculate(QuoteTransfer $quoteTransfer): QuoteTransfer;
}
